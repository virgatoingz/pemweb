-Website = kumpulan halaman yang saling terhubung dan berisi informasi yang dapat diakses melalui internet
-Address = identitas untuk suatu website di internet
-HTML (hyper text markup leanguage) = bahasa general untuk deploy website
-CSS (cascading style sheet) = bahasa untuk styling html

.env

```
COMPOSE_PROJECT_NAME=toingz "membuat nama project toingz"
REPOSITORY_NAME=pemweb "membuat repository dengan matakuliah pemweb"
IMAGE_TAG=latest
```

.yml

```
version: '3' "versi docker yang akan di pakai"
services: "bawaan"
  web:
    image: nginx:latest
    ports: "setting port"
    - 80:80 "dijalankan di port ini"
    volumes: "tempat dimana naro file"
    - ./nginx/nginx.conf:/etc/nginx/conf.d/default.conf "ini alamat filenya"
```

nginx.conf

```
server {
    listen 80; "dijalankan di server dengan port 80"
    server_name localhost; "dijalankan di dalam server dengan nama local host"

    root /usr/share/nginx/html;
    index index.html index.htm;
  
    location / {
        try_files $uri $uri/ =404;  
    }
}
```

tag a = anchor untuk mengarahkan kesebuah link yg dimasukan didalam dalam tag a

tag h = untuk memasukan heading dengan ukuran 1-6

tag img = untuk memasukan gambar

tag form = untuk membuat formulir untuk diisi oleh user

tag p = untuk membuat paragrap

tag div = tag untuk membagi componen

tag ul li = digunakan untuk membuat daftar tidak berurutan

Rekap hari ini = Belajar dasar HTML dan sedikit pengenalan css ,configurasi nginx, membuat container dan image docker serta memahami dasar tag dalam html
