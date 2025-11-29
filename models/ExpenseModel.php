<?php
class ExpenseModel
{
    private $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }


    //lấy hết chi phí

    public function getAll()
    {

        $sql = "SELECT e.*, t.name AS tour_name
                FROM expenses e
                JOIN tours t ON e.tour_id = t.tour_id
                ORDER BY e.expense_id DESC";

        return $this->conn->query($sql)->fetchAll();
    }

    public function create($tour_id,$type,$amount,$date, $note){
        $sql = "INSERT INTO expenses (tour_id, type, amount, date, note)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$tour_id, $type, $amount, $date, $note]);
    }

    // Lấy 1 chi phí theo ID
    public function getById($id) {
        $sql = "SELECT * FROM expenses WHERE expense_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function update($id, $tour_id, $type, $amount, $date, $note) {
        $sql = "UPDATE expenses
                SET tour_id=?, type=?, amount=?, date=?, note=?
                WHERE expense_id=?";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([$tour_id, $type, $amount, $date, $note, $id]);
    }

     public function delete($id) {
        $sql = "DELETE FROM expenses WHERE expense_id=?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}

?>