#!/bin/bash
echo `top -b -n1 | grep "Cpu(s)" | awk '{print $2 + $4}'`
