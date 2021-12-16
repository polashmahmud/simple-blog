# Simple Blog

## About Simple Blog

This is basically an example blog. Make it using Laravel 8. When I was interview for a job at a company they give me this tasks.

**Task Overview:**
You are requested to create a simple online publishing platform(something like medium) with a membership option. The platform will offer free membership and premium membership to the members. Free members will be able to create 2 posts daily whereas the premium members will be able to create unlimited posts.

**Required Features:**
1) Membership upgrade & downgrade(Free members can update to premium plan and premium members can downgrade to the free plan. You may use stripe to handle the payment.)
2) Post create(Members will be able to create posts based on their membership quota. Each post must have a minimum of 2 fields and these are title and description.)
3) Seeding(You may use laravel Seeder to seed your database with data using seed classes)
4) Task scheduling(Premium members will be able to schedule their posts and the posts will be automatically published at their scheduled time.)
5) Mail queue(The admin will receive mail once a member publishes a post. You may use the mail queue to speed up processing.)
6) Cache(You may use Laravel Cache to load the post from cache instated of loading from the database.)

**Not Mandatory:**
1) Frontend design. We aren't concerned about the frontend design. The frontend can be very basic and you are allowed to use any free fronted template or other resources.
2) You may leave the post comments and reactions part. This is not mandatory but if you want can implement it.
3) Post edit or delete option is not mandatory. It will be a bonus if you can implement it.

**Tools & Technologies:**
1) It is required to use the latest version of laravel.
2) If you are using bootstrap then you must use at least bootstrap 4.
3) Using Vue or React is not mandatory. But if you already know Vue or React then you can use Vue or React. It will increase your hiring possibility.

## Install Project

```javascript
git clone git@github.com:polashmahmud/simple-blog.git
```

```javascript
cd simple-blog
```

```javascript
cp .env.example .env
```

Note: Update .env file information. Like: add database, mail information

```javascript
composer update
```

```javascript
composer update
```

```javascript
 php artisan migrate:fresh --seed
```

```javascript
 php artisan serve
```

Then Open projects on your browser. 

![Screenshot](../main/public/images/readme/1.png)

Login using admin user information and make a Payment package

`Login->Dashboard->Upgrade Package`

![](../main/public/images/readme/2.png)

![](../main/public/images/readme/3.png)

![](../main/public/images/readme/4.png)

Now all done :)

Some Picture

![](../main/public/images/readme/5.png)

![](../main/public/images/readme/6.png)

![](../main/public/images/readme/7.png)

![](../main/public/images/readme/8.png)

![](../main/public/images/readme/9.png)

![](../main/public/images/readme/10.png)

![](../main/public/images/readme/11.png)
