# ECI 用于构建

ECI 是容器服务器，可以将其绑定到 ECS，然后很方便的按需使用 ECI 对程序进行编译和构建。

本项目需参考如下文档：  

* [eci 命令行](https://github.com/aliyuneci/eci-client-doc/blob/main/eci_run.md)
* [eci OpenAPI](https://api.aliyun.com/#/?product=Eci&version=2018-08-08&api=CreateContainerGroup&params={}&tab=DOC&lang=JAVA)
* [eci 命令行文档](https://help.aliyun.com/document_detail/186961.html)

## To do

* 磁盘挂载
* 默认命令行

## 常用命令

```
# 创建一个带宽为 200M 的容器（包含公网IP）
eci run -w 200 -f eci.yaml

# 查看所有容器
eci ps -A

# 删除容器
eci rm c_id

# 获取内网IP
eci inspect c_id | jq -r .ContainerGroups[0].IntranetIp

# 获取公网IP
eci inspect c_id | jq -r .ContainerGroups[0].InternetIp
```
