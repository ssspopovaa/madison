<?php
include_once './models/models.php';
class Controller
{
    public $db;

    /**
     * Controller constructor.
     * @param array $config
     */
    public function __construct($config)
    {
        $this->db = new PDO('mysql:host=' . $config['db_host'] . ';dbname=' . $config['db_name'],
            $config['db_user'],
            $config['db_pass']
        );

        $this->db->exec('set names utf8');
        
    }
        //Load start page with product list
    
    public function indexAction()
    {
        $sth = $this->db->prepare('SELECT * FROM products');
        $sth->execute();
        
        $products = $sth->fetchAll(PDO::FETCH_ASSOC);
        
        require_once 'templates/index.phtml';
        
    }
        // Add data to table "discount"
    public function discountAction()
    {
        $product_id= intval($_POST['product_id']);
        $first_date= strtotime($_POST['first_date']);
        $last_date= strtotime($_POST['last_date']);
        $discount_price=$_POST['discont_price'];
        $period = ($last_date-$first_date)/3600/24;
        $date_added = time();
        
        $sql = $this->db->prepare('insert into discount(prod_id,first_date,last_date,period,date_added,price)'
               .'VALUES ('.$product_id.','.$first_date.','.$last_date.','.$period.','.$date_added.','.$discount_price.')');
        $result = $sql->execute();
        if ($result){echo "Период действия скидки добавлен в базу данных";}
        else {echo 'Что-то пошло не так. Возможно Вы не заполнили какое-то поле';}
    }
        // Return json with actual price method 1

    public function method1Action()
    {
        $prod_id = intval($_POST['prod_id']);
        $date= strtotime($_POST['date']);
        
        $sql = models::getPrice($prod_id);
        header('Content-Type: application/json');
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        $sql_discount = models::getDiscountPrice($prod_id,$date);
        
        if ($sql_discount->rowCount()>0){
         //   header('Content-Type: application/json');
        $result = $sql_discount->fetchAll(PDO::FETCH_ASSOC);
        }
        return json_encode($result);
           
    }
    
 // Return json with actual price method 2
    public function method2Action()
    {
        $prod_id = intval($_POST['prod_id']);
        $date= strtotime($_POST['date']);
        
        $sql = models::getPrice($prod_id);
        header('Content-Type: application/json');
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        $sql_discount = models::getDiscountPrice2($prod_id,$date);
        
        if ($sql_discount->rowCount()>0){
         //   header('Content-Type: application/json');
        $result = $sql_discount->fetchAll(PDO::FETCH_ASSOC);
        }
        return json_encode($result);
        
    }
    public function chartAction() {
        $chart_id = intval($_POST['chart_id']); //product id
        $chart_f= strtotime($_POST['chart_f']); //first date
        $chart_l= strtotime($_POST['chart_l']); //last date
        
        $i = 0;
        $j = 60*60*24;
        
        $date = $chart_f;
        
        do{
        $sql = models::getPrice($chart_id);
        //header('Content-Type: application/json');
        $result[$date][$i] = $sql->fetchAll(PDO::FETCH_ASSOC);

        $sql_discount = models::getDiscountPrice($chart_id,$date);
        
        if ($sql_discount->rowCount()>0){
         //   header('Content-Type: application/json');
        $result[$date][$i] = $sql_discount->fetchAll(PDO::FETCH_ASSOC);
        }
            $i++;
            $date = intval($date) + intval($j);
        }
        while ($date <= $chart_l);
        //header('Content-Type: application/json');
        return $result;
            
   }
}