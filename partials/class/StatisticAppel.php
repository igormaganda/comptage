<?php
class StatistAppel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getStats($dstart, $dend, $account) {
        if ($dstart && $dend && $account) {
            $reqSQL = "SELECT 
                SUM(\"stats_count\") AS sum_count, 
                SUM(\"stats_campagnes\") AS sum_camp, 
                SUM(\"stats_contact\") AS sum_cont, 
                SUM(\"stats_revenus\") AS sum_reven,
                SUM(\"stats_charge\") AS sum_charge
            FROM 
                public.stats_appel_account
            WHERE \"date_appel\" BETWEEN :dstart AND :dend
            AND \"stats_email\" = :account;";

            $stmt = $this->conn->prepare($reqSQL);
            $stmt->bindParam(':dstart', $dstart);
            $stmt->bindParam(':dend', $dend);
            $stmt->bindParam(':account', $account);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $reqSQL = "SELECT 
                SUM(\"stats_count\") AS sum_count, 
                SUM(\"stats_campagnes\") AS sum_camp, 
                SUM(\"stats_contact\") AS sum_cont, 
                SUM(\"stats_revenus\") AS sum_reven,
                SUM(\"stats_charge\") AS sum_charge
            FROM 
                public.stats_appel_account;";

            return $this->conn->query($reqSQL)->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function getOrders($dstart, $dend, $account) {
        if ($dstart && $dend && $account) {
            $reqSQL = "SELECT * FROM order_api 
            WHERE \"order_date\" BETWEEN :dstart AND :dend
            AND \"email\" = :account;";
            $stmt = $this->conn->prepare($reqSQL);
            $stmt->bindParam(':dstart', $dstart);
            $stmt->bindParam(':dend', $dend);
            $stmt->bindParam(':account', $account);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $reqSQL = "SELECT * FROM order_api";
            return $this->conn->query($reqSQL)->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function getDistinctEmails() {
        $reqSQL = "SELECT DISTINCT \"stats_email\" FROM public.stats_appel_account ORDER BY \"stats_email\" ASC";
        return $this->conn->query($reqSQL)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGraphData($dstart, $dend, $account) {
        if ($dstart && $dend && $account) {
            $reqSQL = "SELECT 
                    TO_CHAR(TO_TIMESTAMP(\"date_appel\", 'YYYY-MM-DD'), 'YYYY-MM-DD') AS date_group,
                    SUM(\"stats_count\") AS stats_count,
                    SUM(\"stats_campagnes\") AS stats_campagnes,
                    SUM(\"stats_revenus\") AS stats_revenus
                FROM stats_appel_account
                WHERE \"date_appel\" BETWEEN :dstart AND :dend
                AND \"stats_email\" = :account
                GROUP BY TO_CHAR(TO_TIMESTAMP(\"date_appel\", 'YYYY-MM-DD'), 'YYYY-MM-DD')
                ORDER BY date_group ASC";

            $stmt = $this->conn->prepare($reqSQL);
            $stmt->bindParam(':dstart', $dstart);
            $stmt->bindParam(':dend', $dend);
            $stmt->bindParam(':account', $account);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $reqSQL = "SELECT 
                TO_CHAR(TO_TIMESTAMP(\"date_appel\", 'YYYY-MM-DD'), 'YYYY-MM-DD') AS date_group,
                SUM(\"stats_count\") AS stats_count,
                SUM(\"stats_campagnes\") AS stats_campagnes,
                SUM(\"stats_revenus\") AS stats_revenus
            FROM stats_appel_account
            WHERE TO_TIMESTAMP(\"date_appel\", 'YYYY-MM-DD') >= CURRENT_DATE - INTERVAL '29 days'
            AND TO_TIMESTAMP(\"date_appel\", 'YYYY-MM-DD') <= CURRENT_DATE + INTERVAL '1 day'
            GROUP BY TO_CHAR(TO_TIMESTAMP(\"date_appel\", 'YYYY-MM-DD'), 'YYYY-MM-DD')
            ORDER BY date_group ASC;";

            return $this->conn->query($reqSQL)->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}
?>
