#!/bin/bash

for file in $(find . -type f ! -name $(basename "$(test -L "$0" && readlink "$0" || echo "$0")") -maxdepth 1)
do
	echo $file;
	awk '{print $3}' $file | sort | uniq -c;
done
