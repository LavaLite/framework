#!/usr/bin/env bash

set -e
set -x

CURRENT_BRANCH="10.x"

function split()
{
    SHA1=`./bin/splitsh-lite --prefix=$1`
    git push $2 "$SHA1:refs/heads/$CURRENT_BRANCH" -f
}

function remote()
{
    git remote add $1 $2 || true
}

git pull origin $CURRENT_BRANCH

remote actions git@github.com:litepie/actions.git
remote database git@github.com:litepie/database.git
remote filer git@github.com:litepie/filer.git
remote form git@github.com:litepie/form.git
remote hashids git@github.com:litepie/hashids.git
remote http git@github.com:litepie/http.git
remote install git@github.com:litepie/install.git
remote log git@github.com:litepie/log.git
remote master git@github.com:litepie/master.git
remote menu git@github.com:litepie/menu.git
remote node git@github.com:litepie/node.git
remote notification git@github.com:litepie/notification.git
remote repository git@github.com:litepie/repository.git
remote role git@github.com:litepie/role.git
remote setting git@github.com:litepie/setting.git
remote team git@github.com:litepie/team.git
remote theme git@github.com:litepie/theme.git
remote trans git@github.com:litepie/trans.git
remote user git@github.com:litepie/user.git
remote validator git@github.com:litepie/validator.git
remote workflow git@github.com:litepie/workflow.git

split 'src/Litepie/Actions' actions
split 'src/Litepie/Database' database
split 'src/Litepie/Filer' filer
split 'src/Litepie/Form' form
split 'src/Litepie/Hashids' hashids
split 'src/Litepie/Http' http
split 'src/Litepie/Install' install
split 'src/Litepie/Log' log
split 'src/Litepie/Master' master
split 'src/Litepie/Menu' menu
split 'src/Litepie/Node' node
split 'src/Litepie/Notification' notification
split 'src/Litepie/Repository' repository
split 'src/Litepie/Role' role
split 'src/Litepie/Setting' setting
split 'src/Litepie/Team' team
split 'src/Litepie/Theme' theme
split 'src/Litepie/Trans' trans
split 'src/Litepie/User' user
split 'src/Litepie/Validator' validator
split 'src/Litepie/Workflow' workflow

./git-subsplit.sh init git@github.com:lavalite/framework.git
./git-subsplit.sh publish   --heads="develop master 7.x" --tags="v7.0.0"  src/Litepie/Activities:git@github.com:Litepie/Activities.git
./git-subsplit.sh publish   --heads="develop master 7.x" --tags="v7.0.0"  src/Litepie/Database:git@github.com:Litepie/Database.git
./git-subsplit.sh publish   --heads="develop master 7.x" --tags="v7.0.0"  src/Litepie/Filer:git@github.com:Litepie/Filer.git
./git-subsplit.sh publish   --heads="develop master 7.x" --tags="v7.0.0"  src/Litepie/Form:git@github.com:Litepie/Form.git
./git-subsplit.sh publish   --heads="develop master 7.x" --tags="v7.0.0"  src/Litepie/Hashids:git@github.com:Litepie/Hashids.git
./git-subsplit.sh publish   --heads="develop master 7.x" --tags="v7.0.0"  src/Litepie/Http:git@github.com:Litepie/Http.git
./git-subsplit.sh publish   --heads="develop master 7.x" --tags="v7.0.0"  src/Litepie/Install:git@github.com:Litepie/Install.git
./git-subsplit.sh publish   --heads="develop master 7.x" --tags="v7.0.0"  src/Litepie/Master:git@github.com:Litepie/Master.git
./git-subsplit.sh publish   --heads="develop master 7.x" --tags="v7.0.0"  src/Litepie/Menu:git@github.com:Litepie/Menu.git
./git-subsplit.sh publish   --heads="develop master 7.x" --tags="v7.0.0"  src/Litepie/Node:git@github.com:Litepie/Node.git
./git-subsplit.sh publish   --heads="develop master 7.x" --tags="v7.0.0"  src/Litepie/Repository:git@github.com:Litepie/Repository.git
./git-subsplit.sh publish   --heads="develop master 7.x" --tags="v7.0.0"  src/Litepie/Roles:git@github.com:Litepie/Roles.git
./git-subsplit.sh publish   --heads="develop master 7.x" --tags="v7.0.0"  src/Litepie/Settings:git@github.com:Litepie/Settings.git
./git-subsplit.sh publish   --heads="develop master 7.x" --tags="v7.0.0"  src/Litepie/Team:git@github.com:Litepie/Team.git
./git-subsplit.sh publish   --heads="develop master 7.x" --tags="v7.0.0"  src/Litepie/Theme:git@github.com:Litepie/Theme.git
./git-subsplit.sh publish   --heads="develop master 7.x" --tags="v7.0.0"  src/Litepie/Trans:git@github.com:Litepie/Trans.git
./git-subsplit.sh publish   --heads="develop master 7.x" --tags="v7.0.0"  src/Litepie/User:git@github.com:Litepie/User.git
rm -rf .subsplit/