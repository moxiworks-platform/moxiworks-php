#!/bin/sh

rm -r output

git checkout master

git commit -a -m "Documentation Update"

php phpDocumentor.phar -d src

git checkout gh-pages

cd output

for i in `ls`
do
    rm -r ../$i
    mv $i ../$i
done

cd -

git add classes files

git commit -a -m "Documentation Update"

git push origin gh-pages --force
git push upstream gh-pages --force

git checkout master
