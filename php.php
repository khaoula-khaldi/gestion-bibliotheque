<?php

class student{
    private string $name;
    private int $age;
    private string $filiere;

    public function __construct($name,$age,$filiere){
        $this->filiere=$filiere;
        $this->name=$name;
        $this->age=setAge($age);
    }
    public function setAge($age){
        if($age>18){
            $this->age=$age;
        }
    }

    public function showInfo(){
        return "le nom :" .$this->name . "l'age:" . $this->age ."filiere : " . $this->filiere;
    }

}

$student1=new student("ahmed","20","physique"); 
$student2=new student("oussama","26","chimie"); 
$student3=new student("leila","24","electrisite");

class BankAccount{
    private string $owner;
    private float $balance;

    public function __construct($owner,$balance){
        $this->owner=$owner;
        $this->balance=$balance;
    }
    public function deposit($amount){
        if($amount>0){
            $this->balance+$amount;
        }else{
            echo "inmpossible!!";
        }
    }
    public function withdraw($amount){
        if($amount<=$this->balance){
            $this->balance-$amount;
        }else{
            echo "impossible!";
        }   
    }
    public function getBalance(){
        return $this->balance;
    }
}


class person{
    protected string $name;
    protected string $email;

    public function __construct($name,$email){
        $this->name=$name;
        $this->email=setEmail($email);
    }
    public function setEmail($email){
        if($email= "%@gmail.com"){
            $this->email=$email;
        }
    }
    public function introduce(){}

}

class teacher extends person{
private string $subject;

public function __construct($subject,$name,$email){
    parent::__construct($name,$email);
    $this->subject=$subject;
}


public function introduce(){
    return $this->subject;
}

}

class student extends person{

private string $grade;

public function __construct($grade,$name,$email){
    parent::__construct($name,$email);
    $this->grade=$grade;
}


public function introduce(){
    return $this->grade;
}

}


abstract class vehicle{
    protected string $brand;
    protected float $speed;

    public function __construct($brand,$speed){
        $this->brand=$brand;
        $this->speed=$speed;
    }

    public function start(){

    }

    abstract public function move();
}

class car extends vehicle{

    public function __construct($brand,$speed){
        parent::__construct($brand,$speed);
    }

    public function move(){

    }
}

class Bike extends vehicle{

    public function __construct($brand,$speed){
        parent::__construct($brand,$speed);
    }

    public function move(){

    }

}

