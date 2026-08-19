<?PHP
    $dbhost = "localhost" ;
    $dbuser = "root" ;
    $dbpass = "root" ;

    $conn = mysqli_connect($dbhost, $dbuser ,$dbpass);

    if(!$conn)
    {
        die("failed to connect!");
    }

    $DBCreate = "CREATE DATABASE scotts";

    if(mysqli_query($conn, $DBCreate))
    {

        mysqli_select_db($conn, "scotts");
        $dbSetup = "

        SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
        SET time_zone = '+00:00';

        CREATE TABLE bookings (
            BookingID int(11) NOT NULL,
            CustomerID bigint(20) NOT NULL,
            Registration varchar(20) NOT NULL,
            BookedDate date NOT NULL,
            BookedTime time NOT NULL,
            BookingMade timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            CompletedOn datetime NOT NULL,
            Info varchar(1000) NOT NULL DEFAULT '-',
            Complete tinyint(1) NOT NULL DEFAULT '0'
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
          
        CREATE TABLE cars (
            Registration varchar(8) NOT NULL,
            Make varchar(100) DEFAULT NULL,
            Model varchar(1000) DEFAULT NULL,
            ModelYear varchar(4) NOT NULL,
            Colour varchar(100) DEFAULT NULL,
            Type varchar(100) NOT NULL,
            user_id bigint(20) DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
           
        INSERT INTO cars (Registration, Make, Model, ModelYear, Colour, Type, user_id) VALUES
        ('GR55 SPR', 'Toyota', 'GR Supra', '2023', 'White', 'Coupe', 8);
        
        CREATE TABLE customerdetails (
            CustomerID bigint(20) NOT NULL,
            FirstName varchar(200) NOT NULL,
            LastName varchar(200) NOT NULL,
            Phone bigint(11) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
          
        INSERT INTO customerdetails (CustomerID, FirstName, LastName, Phone) VALUES
        (8, 'Vinuk', 'Gunasekara', 7305155623);
          
        CREATE TABLE logindetails (
            id bigint(20) NOT NULL,
            user_name varchar(100) NOT NULL,
            password varchar(100) NOT NULL,
            Admin tinyint(1) NOT NULL,
            Disabled tinyint(1) NOT NULL DEFAULT '0'
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
          
        INSERT INTO logindetails (id, user_name, password, Admin, Disabled) VALUES
        (8, 'vinukg@scottsmotcentre.com', '$2y$10\$bkR9WwSovO/O9xuj4yojmOGoSBFoZnIbaKZYZkL5sKPMTi4He6/zS', 1, 0);
          
        CREATE TABLE priceestimate (
            Type varchar(100) NOT NULL,
            Price varchar(100) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
          
        INSERT INTO priceestimate (Type, Price) VALUES
        ('Cabriolet', '43.50'),
        ('Coupe', '43.00'),
        ('Crossover/SUV', '48.00'),
        ('Estate', '44.00'),
        ('Hatchback', '40.00'),
        ('Motor', '52.00'),
        ('Motorcycle', '38.00'),
        ('MPV', '43.00'),
        ('Saloon', '42.50');
          
         ALTER TABLE bookings
            ADD PRIMARY KEY (BookingID),
            ADD KEY CustomerID (CustomerID),
            ADD KEY Registration (Registration);
          
         ALTER TABLE cars
            ADD PRIMARY KEY (Registration),
            ADD UNIQUE KEY Registration (Registration),
            ADD KEY user_id (user_id);
          
        ALTER TABLE customerdetails
            ADD PRIMARY KEY (CustomerID),
            ADD KEY CustomerID (CustomerID);
          
        ALTER TABLE logindetails
            ADD PRIMARY KEY (id),
            ADD KEY user_name (user_name);
          
        ALTER TABLE priceestimate
            ADD PRIMARY KEY (Type);
          
         
        ALTER TABLE bookings
            MODIFY BookingID int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
         
        ALTER TABLE logindetails
            MODIFY id bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
         
        ALTER TABLE bookings
            ADD CONSTRAINT customerBooked FOREIGN KEY (CustomerID) REFERENCES logindetails (id) ON DELETE CASCADE ON UPDATE CASCADE,
            ADD CONSTRAINT customerBookedVehicle FOREIGN KEY (Registration) REFERENCES cars (Registration) ON DELETE CASCADE ON UPDATE CASCADE;
          
        ALTER TABLE cars
            ADD CONSTRAINT customerVehicle FOREIGN KEY (user_id) REFERENCES logindetails (id);
          
        ALTER TABLE customerdetails
            ADD CONSTRAINT customerDetails FOREIGN KEY (CustomerID) REFERENCES logindetails (id) ON DELETE CASCADE ON UPDATE CASCADE;";
        

        if (mysqli_multi_query($conn, $dbSetup))
        {
            echo '<script> console.log("DB tables setup"); </script>';
        } else
        {
            echo mysqli_error($conn);
        }
    }

?>