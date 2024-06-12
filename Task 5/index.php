<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../Bootstrap & Font Awsome/CSS/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
        <title>Task 5</title>
    </head>
    <body>
        <section class="function">
            <div class="container">
                <h1>Play with Function</h1>
                <div class="row">
                    <div class="col">
                        <h5>Function With 2 Parameters & Return Sum </h5>
                        <?php                         
                            function sum($num1, $num2){
                                $sum = $num1 + $num2;
                                return $sum;
                            }
                            $num1=10;
                            $num2=20;
                            echo "<span>Sum of ".$num1." and ".$num2." = ".sum($num1, $num2)."</span>";
                        ?>
                    </div>
                    <div class="col">
                        <h5>Function With 2 Parameters & Given Value of 3 </h5>
                        <?php                         
                            function sum2($num1, $num2, $num3=30){
                                $sum = $num1 + $num2 + $num3;
                                return $sum;
                            }
                            $num1=10;
                            $num2=20;
                            echo "<span>Sum of ".$num1.", ".$num2." and 30 = ".sum2($num1, $num2)."</span>";
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h5>Function With 2 Parameters call By Value </h5>
                        <?php                         
                            function sum3($num1, $num2){
                                $sum = $num1 + $num2 ;
                                $num1++;
                                echo "<span>This Is num1 = ".$num1." Value In Function</span> <br>";
                                return $sum;
                            }
                            $num1=10;
                            $num2=20;
                            echo "<span>This Is num1 = ".$num1." Value before Call</span> <br>";
                            echo "<span>Sum of ".$num1.", ".$num2." = ".sum3($num1, $num2)."</span> <br>";
                            echo "<span>This Is num1 = ".$num1." Value After Call</span> <br>";
                        ?>
                    </div>
                    <div class="col">
                        <h5>Function With 2 Parameters call By Reference </h5>
                        <?php                         
                            function sum4(&$num1, $num2){
                                $sum = $num1 + $num2 ;
                                $num1++;
                                echo "<span>This Is num1 = ".$num1." Value In Function</span> <br>";
                                return $sum;
                            }
                            $num1=10;
                            $num2=20;
                            echo "<span>This Is num1 = ".$num1." Value before Call</span> <br>";
                            echo "<span>Sum of ".$num1.", ".$num2." = ".sum4($num1, $num2)."</span> <br>";
                            echo "<span>This Is num1 = ".$num1." Value After Call</span> <br>";
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h5>Function With Array of Args </h5>
                        <?php                         
                            function sum5(...$args){
                                $sum = 0;
                                foreach($args as $arg){
                                    $sum += $arg;
                                }
                                return $sum;
                            }
                            echo "<span>Sum of 10, 20, 30, 40, 50 = ".sum5(10, 20, 30, 40, 50)."</span>";
                        ?>
                    </div>
                    <div class="col">
                        <h5>Variable As Function</h5>
                        <?php                         
                            $sum = function($num1, $num2){
                                $sum = $num1 + $num2;
                                return $sum;
                            };
                            echo "<span>Sum of 10, 20 = ".$sum(10, 20)."</span>";
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <section class=" function">
            <div class="container">
                <h1>Play with OOP</h1>
                <div class="row">
                    <div class="col">
                        <h5>Create Class and Object</h5>
                        <?php                         
                            class Person{
                                public $name;
                                public $age;
                                public $city;
                                public function __construct($name, $age, $city){
                                    $this->name = $name;
                                    $this->age = $age;
                                    $this->city = $city;
                                }
                                public function getPersonInfo(){
                                    return "<span>Name: ".$this->name."</span><span>Age: ".$this->age."</span><span>City: ".$this->city."</span>";
                                }
                            }
                            $person = new Person("Elomda", 24, "Assuit");
                            echo $person->getPersonInfo();
                        ?>
                    </div>
                    <div class="col">
                        <h5>Access modifiers</h5>
                        <?php                         
                            class Person2{
                                public $name;
                                private $age;
                                protected $city;
                                public function __construct($name, $age, $city){
                                    $this->name = $name;
                                    $this->age = $age;
                                    $this->city = $city;
                                }
                                public function getPersonInfo(){
                                    return "<span>Name: ".$this->name."</span><span>Age: ".$this->age."</span><span>City: ".$this->city."</span>";
                                }
                            }
                            $person = new Person2("Ali", 30, "cairo");
                            echo $person->getPersonInfo();
                        ?>
                    </div>
                </div>
            </div>
        </section>
    <script src="../Bootstrap & Font Awsome/JS/bootstrap.bundle.min.js"></script>
    </body>
</html>