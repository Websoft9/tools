# mPackage

## 背景

软件部署过程中，在主流的仓库上有些组件没有 deb/rpm 包，导致需要通过编译安装，而编译存在如下几个问题：

* 时间长
* 编译容易报错
* 用户无法升级

另外，有一部分 deb/rpm 包会可能逐渐被仓库提供方删除，导致后期无包可用，此时要提前做好备份机制以备用。

经过分析和实践，自建 repo 仓库是一种不错的选择，可以通过如下两个方式解决以上问题：

* 提前编译一部分包存放到仓库
* 主动下载一部分包存放到仓库

## 方案设计

自建 repo 仓库主要分为三个主要部分：

* 工作单：按软件名称，对工作任务进行归类，每一个任务一个清单文件（yml）
```
name: Python3.7
URL: https://www.python.org/ftp/python/3.7.4/Python-3.7.4.tgz
distros: 
  centos: [6,7]
  ubuntu: [18.04,19.04]
arches: [x86_64, arm, ]
```

rpm/deb 高度依赖操作系统发行版和CPU架构

* 加工器
```
判断 URL，若后缀为 deb/rpm，则下载安装包即可；否则解压下载包构建 deb/rpm
```

* 传输器

安装包加工完成后，需通过传输器送到指定仓库的相关路径。
设计采用 Github action 完成此项任务

* 仓库

仓库即最终存放 deb/rpm 包的货架，货架要符合 apt/yum 分发模式。  
仓库以 Azure Blob 作为存储库，URL为：https://download.websoft9.com


## 详细设计

编译软件所需的依赖
```
yum install gcc gcc-c++ make automake autoconf rpm-build
```
