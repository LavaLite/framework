#
# This will split up each Lavalite library to its own github repo
#

./git-subsplit.sh init git@github.com:lavalite/framework.git
./git-subsplit.sh publish --no-tags src/Litepie/Alerts:git@github.com:Litepie/alerts.git
./git-subsplit.sh publish --no-tags src/Litepie/Calendar:git@github.com:Litepie/calendar.git
./git-subsplit.sh publish --no-tags src/Litepie/Contracts:git@github.com:Litepie/contracts.git
./git-subsplit.sh publish --no-tags src/Litepie/Database:git@github.com:Litepie/database.git
./git-subsplit.sh publish --no-tags src/Litepie/Filer:git@github.com:Litepie/filer.git
./git-subsplit.sh publish --no-tags src/Litepie/Form:git@github.com:Litepie/form.git
./git-subsplit.sh publish --no-tags src/Litepie/Hashids:git@github.com:Litepie/hashids.git
./git-subsplit.sh publish --no-tags src/Litepie/Menu:git@github.com:Litepie/menu.git
./git-subsplit.sh publish --no-tags src/Litepie/Menu:git@github.com:Litepie/menu.git
./git-subsplit.sh publish --no-tags src/Litepie/Message:git@github.com:Litepie/message.git
./git-subsplit.sh publish --no-tags src/Litepie/Node:git@github.com:Litepie/node.git
./git-subsplit.sh publish --no-tags src/Litepie/Repository:git@github.com:Litepie/repository.git
./git-subsplit.sh publish --no-tags src/Litepie/Revision:git@github.com:Litepie/revision.git
./git-subsplit.sh publish --no-tags src/Litepie/Settings:git@github.com:Litepie/settings.git
./git-subsplit.sh publish --no-tags src/Litepie/Task:git@github.com:Litepie/task.git
./git-subsplit.sh publish --no-tags src/Litepie/Trans:git@github.com:Litepie/trans.git
./git-subsplit.sh publish --no-tags src/Litepie/User:git@github.com:Litepie/user.git
./git-subsplit.sh publish --no-tags src/Litepie/Workflow:git@github.com:Litepie/workflow.git
rm -rf .subsplit/