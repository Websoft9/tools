# Blog

本项目是 Websoft9 [公司博客](https://blog.websoft9.com)的网站源码。

项目基于 Ghost 博客，采用 Docker 部署

* 主题：[liebling](https://github.com/eddiesigner/liebling)

## DevOps

项目采用了 DevOps， 具体为：

* 手工修改主题版本触发同步官方主题
* 通过构建步骤实现代码修改，并push回来
* 持续部署到云服务器（暂未实现）

## 常见问题

#### 如何维护 liebling 的版本？

修改 *.github/workflows/liebling.yml* 文件中的 `https://github.com/eddiesigner/liebling/archive/v.0.9.1.zip` 下载地址，即可触发更新和替换流程

#### Websoft9 是否对 liebling 源码进行修正？

通过 Github Action 文件 *.github/workflows/liebling.yml* 进行少量修正
