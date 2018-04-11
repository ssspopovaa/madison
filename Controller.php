<?php

class Controller
{
    protected $db;

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
        //Загрузка стартовой страницы
    
    public function indexAction()
    {
        $sth = $this->db->prepare('SELECT * FROM products');
        $sth->execute();
        
        $products = $sth->fetchAll(PDO::FETCH_ASSOC);
        
        require_once 'templates/index.phtml';
        
    }
        // Данный метод добавляет данные в таблицу "discount"
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
//        $sth = $this->db->prepare('insert `id`, (select name from offers where id = offer_id) AS name, `price`, `count`, (select name from operators where id = operator_id) AS oper FROM `requests` WHERE count >2 and (operator_id = 10 or operator_id = 12)');
//        
//        $sth->execute();
//        header('Content-Type: application/json');
//        return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
//    }
    
        // Определение цены товара по первому методу
    public function Method1Action()
    {
        $prod_id = intval($_POST['prod_id']);
        $date= strtotime($_POST['date']);
                
        $sql = $this->db->query('SELECT `price` FROM `discount` WHERE prod_id = '.$prod_id
         .' and ('.$date.' between first_date and last_date)');
        if (!empty($sql)){
            header('Content-Type: json');
        return json_encode($sql->fetchAll(PDO::FETCH_ASSOC));            
        }else{
             $sql = $this->db->query('SELECT `price` FROM `products` WHERE `id` = '.$prod_id);
             header('Content-Type: json');
        return json_encode($sql->fetchAll(PDO::FETCH_ASSOC));
        }

    }
    
 // Определение цены товара по первому методу
    public function Method2Action()
    {
        $product_id= intval($_POST['prod_id']);
        $date= strtotime($_POST['date']);
        echo "$date.'+'.$product_id";
//        $sth = $this->db->prepare('SELECT (select name from offers where id = offer_id) AS name, `count`, (`count` * `price`) AS sum FROM `requests` GROUP by name');
//        $sth->execute();
//        header('Content-Type: application/json');
//        return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
    }

}