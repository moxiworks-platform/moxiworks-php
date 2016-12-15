#!/bin/sh

rm -r output

git checkout master

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

git checkout master
