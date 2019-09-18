#
# This will split up each Lavalite library to its own github repo
#

./git-subsplit.sh init git@github.com:lavalite/framework.git
./git-subsplit.sh publish src/Litepie/Activities:git@github.com:Litepie/Activities.git
./git-subsplit.sh publish src/Litepie/Database:git@github.com:Litepie/Database.git
./git-subsplit.sh publish src/Litepie/Filer:git@github.com:Litepie/Filer.git
./git-subsplit.sh publish src/Litepie/Form:git@github.com:Litepie/Form.git
./git-subsplit.sh publish src/Litepie/Hashids:git@github.com:Litepie/Hashids.git
./git-subsplit.sh publish src/Litepie/Http:git@github.com:Litepie/Http.git
./git-subsplit.sh publish src/Litepie/Install:git@github.com:Litepie/Install.git
./git-subsplit.sh publish src/Litepie/Master:git@github.com:Litepie/Master.git
./git-subsplit.sh publish src/Litepie/Menu:git@github.com:Litepie/Menu.git
./git-subsplit.sh publish src/Litepie/Node:git@github.com:Litepie/Node.git
./git-subsplit.sh publish src/Litepie/Repository:git@github.com:Litepie/Repository.git
./git-subsplit.sh publish src/Litepie/Roles:git@github.com:Litepie/Roles.git
./git-subsplit.sh publish src/Litepie/Settings:git@github.com:Litepie/Settings.git
./git-subsplit.sh publish src/Litepie/Team:git@github.com:Litepie/Team.git
./git-subsplit.sh publish src/Litepie/Theme:git@github.com:Litepie/Theme.git
./git-subsplit.sh publish src/Litepie/Trans:git@github.com:Litepie/Trans.git
./git-subsplit.sh publish src/Litepie/User:git@github.com:Litepie/User.git
rm -rf .subsplit/