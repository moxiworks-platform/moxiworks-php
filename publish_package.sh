#!/bin/sh

the_version=`cat composer.json | grep "version" | sed "s/^.*\ //g" | sed 's/["|,]//g'`
branch=`git rev-parse --abbrev-ref HEAD`

git commit -a -m "${the_version}"
git tag -a "${the_version}" -m "${the_version}"
git fetch upstream
git merge upstream/${branch}
git push origin ${branch}
git push upstream ${branch}
git push upstream "${the_version}"

