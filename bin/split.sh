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

function remove()
{
    git remote rm $1 || true
}

# git pull origin $CURRENT_BRANCH

remote actions git@github.com:Litepie/Actions.git
remote database git@github.com:Litepie/Database.git
remote filer git@github.com:Litepie/Filer.git
remote foremove git@github.com:Litepie/Form.git
remote hashids git@github.com:Litepie/Hashids.git
remote http git@github.com:Litepie/Http.git
remote install git@github.com:Litepie/Install.git
remote log git@github.com:Litepie/Log.git
remote master git@github.com:Litepie/Master.git
remote menu git@github.com:Litepie/Menu.git
remote node git@github.com:Litepie/Node.git
remote notification git@github.com:Litepie/Notification.git
remote repository git@github.com:Litepie/Repository.git
remote role git@github.com:Litepie/Role.git
remote setting git@github.com:Litepie/Setting.git
remote team git@github.com:Litepie/Team.git
remote theme git@github.com:Litepie/Theme.git
remote trans git@github.com:Litepie/Trans.git
remote user git@github.com:Litepie/User.git
remote validator git@github.com:Litepie/Validator.git
remote workflow git@github.com:Litepie/Workflow.git

split './src/Litepie/Actions' actions
split './src/Litepie/Database' database
split './src/Litepie/Filer' filer
split './src/Litepie/Form' form
split './src/Litepie/Hashids' hashids
split './src/Litepie/Http' http
split './src/Litepie/Install' install
split './src/Litepie/Log' log
split './src/Litepie/Master' master
split './src/Litepie/Menu' menu
split './src/Litepie/Node' node
split './src/Litepie/Notification' notification
split './src/Litepie/Repository' repository
split './src/Litepie/Role' role
split './src/Litepie/Setting' setting
split './src/Litepie/Team' team
split './src/Litepie/Theme' theme
split './src/Litepie/Trans' trans
split './src/Litepie/User' user
split './src/Litepie/Validator' validator
split './src/Litepie/Workflow' workflow

remove actions
remove database
remove filer
remove form
remove hashids
remove http
remove install
remove log
remove master
remove menu
remove node
remove notification
remove repository
remove role
remove setting
remove team
remove theme
remove trans
remove user
remove validator
remove workflow
