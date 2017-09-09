# Pharmacy Finder
### Setup Instructions
###### (Note - this guide assumes you are using Mac/Linux and have VirtualBox and Vagrant installed.)

Unzip Christen Ward - Pharmacy Finder API. Place the Code folder in ~ .
Open your terminal.
``` sh
cd ~
vagrant box add laravel/homestead
```

Choose virtual box as provider. When the box is done downloading, do:
``` sh
git clone https://github.com/laravel/homestead.git Homestead
cd Homestead
git checkout v6.1.0
bash init.sh
```

By default, Homestead is mapped to ~/Code, but you can change this in Homestead.yaml if you wish, and place the Code folder accordingly.
``` sh
vagrant up
```

Once vagrant is booted, navigate to 192.168.10.10. You should see the Laravel page. If not, make sure the Code folder is in the correct place ~, and try ```vagrant reload --provision```

Open your SQL Editor of choice to connect to the database. Connect using these credentials:

Host: 127.0.0.1

Database: homestead

Username: homestead

Password: secret

Port: 33060

Import pharmacies.sql from the zipped folder.

The endpoint to test is: 192.168.10.10/api/pharmacies/{lat},{lng} 
For example, http://192.168.10.10/api/pharmacies/38.883279,-94.651664 is searching for pharmacies nearest lat: 38.883279, lng: -94.651664 and it returns:

``` json
{  
   "status":1,
   "result":{  
      "name":"CVS PHARMACY",
      "address":"5001 WEST 135 ST, LEAWOOD, KS 66224",
      "distance":0.34877395086684804
   }
}
```
