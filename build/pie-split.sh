#
# This will split up each Lavalite library to its own github repo
#

./git-subsplit.sh init git@github.com:lavalite/framework.git
./git-subsplit.sh publish --no-tags src/Litepie/Activities:git@github.com:Litepie/Activities.git
./git-subsplit.sh publish --no-tags src/Litepie/Database:git@github.com:Litepie/database.git
./git-subsplit.sh publish --no-tags src/Litepie/Filer:git@github.com:Litepie/filer.git
./git-subsplit.sh publish --no-tags src/Litepie/Form:git@github.com:Litepie/form.git
./git-subsplit.sh publish --no-tags src/Litepie/Hashids:git@github.com:Litepie/hashids.git
./git-subsplit.sh publish --no-tags src/Litepie/Menu:git@github.com:Litepie/menu.git
./git-subsplit.sh publish --no-tags src/Litepie/Node:git@github.com:Litepie/node.git
./git-subsplit.sh publish --no-tags src/Litepie/Repository:git@github.com:Litepie/repository.git
./git-subsplit.sh publish --no-tags src/Litepie/Roles:git@github.com:Litepie/roles.git
./git-subsplit.sh publish --no-tags src/Litepie/Settings:git@github.com:Litepie/settings.git
./git-subsplit.sh publish --no-tags src/Litepie/Team:git@github.com:Litepie/team.git
./git-subsplit.sh publish --no-tags src/Litepie/Theme:git@github.com:Litepie/theme.git
./git-subsplit.sh publish --no-tags src/Litepie/Trans:git@github.com:Litepie/trans.git
./git-subsplit.sh publish --no-tags src/Litepie/User:git@github.com:Litepie/user.git
rm -rf .subsplit/