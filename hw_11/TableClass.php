<?php
class TableClass 
{
    public function getTable($pdo) 
    {
        $stmt = $pdo->prepare(
                "CREATE TABLE `products` (
                `id` int NOT NULL AUTO_INCREMENT,
                `name` varchar(50) NULL,
                `price` int NOT NULL DEFAULT '0',
                `description` text NOT NULL,
                `date_added` timestamp NOT NULL,
                PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        $stmt->execute();
    }
    
    public function showTable($pdo)
    {
        $stmt = $pdo->prepare("SHOW TABLES;" );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);;
    }
    
    public function describeTable($pdo, $table) 
    {
        $stmt = $pdo->prepare("DESCRIBE `$table`;" );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function del($pdo, $table, $name) 
    {
        $stmt = $pdo->prepare("ALTER TABLE `$table` DROP COLUMN `$name`;");
        $stmt->execute();
    }
    
    public function editTypeField($pdo, $table, $nameFields, $newTypeFields)
    {
        $stmt = $pdo->prepare("ALTER TABLE `$table` MODIFY `$nameFields` $newTypeFields");
        $stmt->execute();
    }
    
    public function editNameField($pdo, $table, $nameFields, $newNameFields)
    {
        $stmt = $pdo->prepare("ALTER TABLE `$table` CHANGE `$nameFields` $newNameFields");
        $stmt->execute();
    }
}
