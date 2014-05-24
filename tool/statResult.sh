#!/bin/bash

for file in $(find . -type f ! -name statResult.sh -maxdepth 1)
do
	echo $file;
	awk '{print $3}' $file | sort | uniq -c;
done
