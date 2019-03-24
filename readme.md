## 1024tools.com

### 开发环境
1. 编译相关镜像： `docker build -f .docker/php/Dockerfile -t 1024tools_php .docker/php`
1. 启动： `docker stack deploy -c docker-compose.yml tools`
1. 登录mysql shell: `docker exec -it <your_mysql_container> -u root -p123456`
1. 初始化mysql： 在mysql shell中执行 `source /tmp/init.sql`
1. 访问 http://127.0.0.1

