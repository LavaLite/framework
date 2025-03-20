#!/usr/bin/env bash

set -e

# Ensure a release tag is provided.
if (( "$#" != 1 )); then
    echo "Tag must be provided."
    exit 1
fi

RELEASE_BRANCH="12.x"
CURRENT_BRANCH=$(git rev-parse --abbrev-ref HEAD)
VERSION=$1

# Ensure current branch matches release branch.
if [[ "$RELEASE_BRANCH" != "$CURRENT_BRANCH" ]]; then
    echo "Release branch ($RELEASE_BRANCH) does not match current branch ($CURRENT_BRANCH)."
    exit 1
fi

# Ensure working directory is clean.
if [[ -n "$(git status --porcelain)" ]]; then
    echo "Working directory is dirty. Commit your changes before releasing."
    exit 1
fi

# Fetch latest changes.
git fetch origin

# Ensure release branch is in sync with origin.
if [[ $(git rev-parse HEAD) != $(git rev-parse origin/$RELEASE_BRANCH) ]]; then
    echo "Branch is out of date with upstream. Pull or push latest changes before releasing."
    exit 1
fi

# Ensure version tag starts with "v"
if [[ $VERSION != v* ]]; then
    VERSION="v$VERSION"
fi

# Tag and push main framework repo
git tag $VERSION
git push origin --tags

# Define repositories
REPOSITORIES=(
    "Actions:Litepie/Actions.git"
    "Database:Litepie/Database.git"
    "Filer:Litepie/Filer.git"
    "Form:Litepie/Form.git"
    "Hashids:Litepie/Hashids.git"
    "Http:Litepie/Http.git"
    "Install:Litepie/Install.git"
    "Log:Litepie/Log.git"
    "Master:Litepie/Master.git"
    "Menu:Litepie/Menu.git"
    "Node:Litepie/Node.git"
    "Notification:Litepie/Notification.git"
    "Repository:Litepie/Repository.git"
    "Role:Litepie/Role.git"
    "Setting:Litepie/Setting.git"
    "States:Litepie/States.git"
    "Team:Litepie/Team.git"
    "Theme:Litepie/Theme.git"
    "Trans:Litepie/Trans.git"
    "User:Litepie/User.git"
    "Validator:Litepie/Validator.git"
    "Workflow:Litepie/Workflow.git"
)

# Process each repository
for REPO in "${REPOSITORIES[@]}"; do
    IFS=":" read -r NAME URL <<< "$REPO"
    echo "\n\nReleasing $NAME ($URL)"
    
    TMP_DIR="/tmp/litepie-$NAME"
    rm -rf $TMP_DIR
    mkdir -p $TMP_DIR

    (
        cd $TMP_DIR
        git clone "git@github.com:$URL" .
        git checkout "$RELEASE_BRANCH"
        git tag $VERSION
        git push origin --tags
    )

done
