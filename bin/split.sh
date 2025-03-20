#!/usr/bin/env bash

set -e  # Exit on any error
set -x  # Print commands as they are executed

# Required software installation note
echo "Ensure the following software is installed before running this script:"
echo "- Git (>=2.22.0)"
echo "- git-filter-repo (install via: 'brew install git-filter-repo' on macOS)"
echo "- A valid GitHub SSH or HTTPS connection"

CURRENT_BRANCH="12.x"
MAIN_REPO_URL="https://github.com/LavaLite/framework.git"
MAIN_REPO_NAME="framework"

# Clone the main repository if it does not exist
if [ ! -d "$MAIN_REPO_NAME" ]; then
    echo "Cloning main repository: $MAIN_REPO_URL"
    git clone "$MAIN_REPO_URL" "$MAIN_REPO_NAME" || { echo "Error cloning main repository"; exit 1; }
fi

cd "$MAIN_REPO_NAME"

# Ensure we are inside a valid Git repository
if ! git rev-parse --is-inside-work-tree &>/dev/null; then
    echo "Error: This script must be run inside a Git repository."
    exit 1
fi

# Check if git filter-repo exists
if ! command -v git-filter-repo &> /dev/null; then
    echo "Error: git-filter-repo not found! Make sure it is installed."
    exit 1
fi

# Ensure the branch exists locally
if ! git show-ref --verify --quiet refs/heads/$CURRENT_BRANCH; then
    git checkout -b "$CURRENT_BRANCH"
    # git push -u origin "$CURRENT_BRANCH"
fi

echo "Starting repository split for branch: $CURRENT_BRANCH"

function split() {
    echo "Splitting $1..."
    REPO_URL=$2
    REPO_NAME=$(basename "$REPO_URL" .git)
    
    # Ensure the target repository exists on GitHub before cloning
    if ! git ls-remote "$REPO_URL" &>/dev/null; then
        echo "Error: Repository $REPO_URL does not exist. Skipping..."
        return
    fi
    
    # Clone the target repository if it doesn't exist
    if [ ! -d "$REPO_NAME" ]; then
        git clone "$REPO_URL" "$REPO_NAME" || { echo "Error cloning $REPO_URL"; exit 1; }
    fi
    
    mkdir -p temp-repo
    git clone --no-checkout . temp-repo || { echo "Error cloning source repository"; exit 1; }
    cd temp-repo
    
    git filter-repo --subdirectory-filter "$1" --force || { echo "Error splitting $1"; exit 1; }
    git remote add origin "$REPO_URL" 2>/dev/null || echo "Remote origin already exists"
    
    # Ensure the branch exists in the target repository
    git checkout -b "$CURRENT_BRANCH" || git checkout "$CURRENT_BRANCH"
    git push -u origin "$CURRENT_BRANCH" -f || { echo "Error pushing to $REPO_URL"; exit 1; }
    
    cd ..
    rm -rf temp-repo
}

function remote() {
    local REPO_NAME=$1
    local REPO_URL=$2
    
    # Ensure URL is properly formatted
    if [[ ! "$REPO_URL" =~ ^https:// ]]; then
        REPO_URL="https://github.com/$REPO_URL"
    fi
    
    git remote add "$REPO_NAME" "$REPO_URL" 2>/dev/null || echo "Remote $REPO_NAME already exists"
}

function remove() {
    git remote remove "$1" 2>/dev/null || echo "Remote $1 does not exist"
}

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

# Add remotes
for repo in "${REPOSITORIES[@]}"; do
    KEY=${repo%%:*}
    VALUE=${repo##*:}
    remote "$KEY" "$VALUE"
    echo "Added remote: $KEY -> https://github.com/$VALUE"
    
    # Ensure branch exists in each repository before pushing
    git fetch "$KEY"
    if ! git ls-remote --heads "$KEY" "$CURRENT_BRANCH" | grep -q "$CURRENT_BRANCH"; then
        git push "$KEY" "$CURRENT_BRANCH"
    fi

done

# Perform splits
for repo in "${REPOSITORIES[@]}"; do
    KEY=${repo%%:*}
    VALUE=${repo##*:}
    split "src/Litepie/$KEY" "https://github.com/$VALUE"
done

# Remove remotes
for repo in "${REPOSITORIES[@]}"; do
    KEY=${repo%%:*}
    remove "$KEY"
done

echo "Repository split completed successfully."
