<?php
class BmiModel {
    private $db;
    private $user_id;

    public function __construct($database, $user_id) {
        $this->db = $database;
        $this->user_id = $user_id;
    }

    public function saveBmiRecord($name, $weight, $height, $bmi, $status) {
        $stmt = $this->db->prepare("INSERT INTO bmi_records (user_id, name, weight, height, bmi, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$this->user_id, $name, $weight, $height, $bmi, $status]);
    }

    public function getBmiHistory() {
        $stmt = $this->db->prepare("SELECT * FROM bmi_records WHERE user_id = ? ORDER BY timestamp DESC");
        $stmt->execute([$this->user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBmiHistoryByUser($user_id) {
        $stmt = $this->db->prepare("SELECT bmi, timestamp FROM bmi_records WHERE user_id = ? ORDER BY timestamp ASC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
