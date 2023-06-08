# rating-system-with-laravel
A basic Rating system that uses seeders to populate the database.

NOTE: This rating systema t no time allows a user to rate a product directly, all data were seeded and thus may
appera off topic. Kindly bear.


VERY IMPORTANT NOTICE:::::::::::::::::::::::::::::
Also, kindly after migrating the database, 
navigate to the Database directory then seeders directory
then open the file DatabaseSeeder.php

that is: database>seeders>DatabaseSeedse.php

now modify this line of code

change this 

 // $this->call(VendorsTableSeeder::class);
        // $this->call(ProductsTableSeeder::class);

        $this->call(UsersTableSeeder::class);
        $this->call(RatingsTableSeeder::class);

To     $this->call(VendorsTableSeeder::class);
       $this->call(ProductsTableSeeder::class);

       // $this->call(UsersTableSeeder::class);
        //$this->call(RatingsTableSeeder::class);


now run php artisan db:seed

******You can ccheck the browser to see the effect of this seed******

then go back to the above line of code you just modified and change 
This

$this->call(VendorsTableSeeder::class);
       $this->call(ProductsTableSeeder::class);

       // $this->call(UsersTableSeeder::class);
        //$this->call(RatingsTableSeeder::class);

back to This

 // $this->call(VendorsTableSeeder::class);
        // $this->call(ProductsTableSeeder::class);

        $this->call(UsersTableSeeder::class);
        $this->call(RatingsTableSeeder::class);
