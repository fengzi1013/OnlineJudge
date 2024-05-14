# Sparks of Fire Online Judge (SparkOJ / LDUOJ)

> A Single Spark Can Start A Prairie Fire  

<div align="center">
  <img src="public/favicon.ico" width="120px"/>
</div>

English | [中文文档](https://docs.lduoj.cn) | [开发日志](https://docs.qq.com/sheet/DR25EbEFCQXhkR2dk)

# 💡 Introduction

- Support for multiple programming languages such as C/C++, Java, Python and Golang. Thank [go-judge](https://github.com/criyle/go-judge).
- Support for multiple types of problems such as Programming and Fill in the Blanks with Code. (代码填空题).
- Contest Rank supports for mode of ACM or IOI and supports for displaying submissions after end of the contest. (赛后补题榜).
- Support for creating groups (including classes and courses) which organize users to participate in contests or assignments.
- Support for one-click import and export of problems, compatible with [hustoj](https://github.com/zhblue/hustoj). (支持一键导入/导出题目，兼容hustoj).

安装docker（若已安装请跳过）；参考文档(opens new window)
# 0. 先清除与docker相关的残余软件包（适用于多次安装docker失败的情况）
sudo apt remove docker docker-engine docker.io containerd runc
# 1. 使用官方脚本安装docker
apt update
sudo curl -fsSL https://get.docker.com | bash -s docker --mirror Aliyun
# 2. 启动docker服务
sudo systemctl enable docker
sudo systemctl start docker
# 3. 查看版本以验证是否安装成功
sudo docker version
如遇拉取镜像总是失败或超时，可更换docker镜像源。
编辑文件/etc/docker/daemon.json：
sudo vim /etc/docker/daemon.json
按i进入编辑模式，在文件中输入以下内容：
{
  "registry-mirrors": [
    "https://mirror.baidubce.com",
    "https://hub-mirror.c.163.com",
    "https://ustc-edu-cn.mirror.aliyuncs.com",
    "https://docker.mirrors.ustc.edu.cn",
    "https://registry.docker-cn.com"
  ]
}
按Esc键退出编辑模式，并输入命令:wq保存文件。
重启docker让配置生效：
sudo systemctl daemon-reload
sudo systemctl restart docker
🔨 部署
1. 获取部署脚本
# 1. 创建项目文件夹并进入
mkdir OnlineJudge
cd OnlineJudge
# 2. 下载部署脚本和配置文件, 注意-O是大写字母O.
curl -O https://gitee.com/winant/OnlineJudge/raw/master/install/docker-compose.yml
curl -O https://gitee.com/winant/OnlineJudge/raw/master/install/lduoj.conf
2. 启动服务
sudo docker compose up -d
访问首页http://ip:8080(该端口在docker-compose.yml中配置)；可在宿主机配置域名；
默认管理员用户：admin，默认密码adminadmin，务必更改默认密码；
💿 备份/迁移
备份
将整个项目文件夹打包备份：

docker compose down  # 务必先停止服务
# 注意是在项目文件夹 OnlineJudge/ 的外层执行备份
tar -cf - ./OnlineJudge | pv | pigz -p $(nproc) > lduoj20230623.tar.gz
恢复
1. 解压备份包
tar -zxvf lduoj20230623.tar.gz  # 解压
mv lduoj20230623 OnlineJudge    # 项目文件夹改一下名字
2. 启动服务
cd OnlineJudge             # 进入项目文件夹
sudo docker compose up -d  # 启动服务
🚗 更新升级
1. 备份数据
升级之前，务必备份！因不备份造成的数据损失，后果自负。

2. 获取最新部署脚本（会直接覆盖旧文件）
cd OnlineJudge  # 进入项目文件夹
# 下载部署脚本和配置文件, 注意-O是大写字母O. 会覆盖旧文件，请提前备份
curl -O https://gitee.com/winant/OnlineJudge/raw/master/install/docker-compose.yml
curl -O https://gitee.com/winant/OnlineJudge/raw/master/install/lduoj.conf
3. 拉取最新镜像，并启动服务
sudo docker compose pull web  # 更新web镜像
sudo docker compose up -d     # 启动服务
# 💝 Acknowledgements

[go-judge](https://github.com/criyle/go-judge)  
[zhblue/hustoj](https://github.com/zhblue/hustoj)  
[laravel](https://laravel.com/)  
[jquery-3.4.1](https://jquery.com/)  
[bootstrap-material-design](https://fezvrasta.github.io/bootstrap-material-design/)  
[font-awesome](http://www.fontawesome.com.cn/)  
[notiflix/Notiflix](https://github.com/notiflix/Notiflix)  
[weatherstar/switch](https://github.com/weatherstar/switch)  
[codemirror](https://codemirror.net/)  
[highlight.js](https://highlightjs.org/)  
[ckeditor-5](https://ckeditor.com/ckeditor-5/)  
[MathJax](https://www.mathjax.org/)  


# 📜 License

OnlineJudge is licensed under the
**[GNU General Public License v3.0](./LICENSE)**.
