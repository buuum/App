Buuum\App - Skeleton App
========================

# Install

### System Requirements

You need PHP >= 5.5.0 to use Buuum\App but the latest stable version of PHP is recommended.

### Step 1 - Composer

Buuum is available on Packagist and can be installed using Composer:

```
composer create-project --prefer-dist buuum/app myapp
```

###  Step 2

Initialize dependencies

```
npm install --save-dev
```

```
bower install -D
```

One time on computer
```
gem install compass
gem install haml
```

```
chmod -R a+rw temp log
```

##  Grunt functions

### Install bower plugins

```
grunt installplugins
```

### Compile sass

grunt buildsass:[scope]

```
grunt buildsass:Web
```

### Compile coffee

grunt buildcoffee:[scope]

```
grunt buildcoffee:Web
```

### Compile haml

grunt buildhaml:[scope]

```
grunt buildhaml:Web
```

### Compile all scope

grunt build:[scope]

```
grunt build:Web
```

### Activate watcher

compile every change file on any scope automatic

```
grunt watch
```

