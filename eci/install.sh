#!/bin/bash
export PATH=/sbin:/bin:/usr/sbin:/usr/bin:/usr/local/sbin:/usr/local/bin
clear

# install ECI cli
sudo bash -c "$(curl -s https://eci-release.oss-cn-beijing.aliyuncs.com/install.sh)"


eci config set-context \
--access-key-id LTAIyHnO9KCe4awI \
--access-secret ×××××××××××××××××××××××××××××××× \
--region-id cn-zhangjiakou \
--security-group-id sg-8vbe54utt8gjfy6irp9p \
--v-switch-id vsw-8vbdt4t3nvfmnmjwl3miv
