#!/bin/bash
FREE_DATA=`free -m | grep Mem`
CURRENT=`echo $FREE_DATA | cut -f3 -d' '`
TOTAL=`echo $FREE_DATA | cut -f2 -d' '`
echo $(echo "scale = 2; $CURRENT/$TOTAL*100" | bc)
