<?php

class StatistNettoyage {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function getNettoyageCount() {
        $reqSQL = "SELECT 
            SUM(\"Email_total\") AS sum_emt, 
            SUM(\"Email_valide\") AS sum_emv, 
            SUM(\"Email_invalide\") AS sum_eminv, 
            SUM(\"Erreur_connexion\") AS sum_errcon 
        FROM 
            public.nettoyage_count;";
        return $this->db->query($reqSQL)->fetch(PDO::FETCH_ASSOC);
    }

    public function getTopServers() {
        $reqToServ = "SELECT 
                        \"Serveur\",
                        SUM(\"Fichier_total\") AS sum_sert, 
                        SUM(\"Fichier_valide\") AS sum_serv, 
                        SUM(\"Fichier_invalide\") AS sum_serinv, 
                        SUM(\"Erreur_connexion\") AS sum_serrcon 
                    FROM 
                        public.nettoyage_serveur 
                    WHERE TO_TIMESTAMP(\"Date_server\", 'YYYY-MM-DD') >= CURRENT_DATE - INTERVAL '29 days'
                    AND TO_TIMESTAMP(\"Date_server\", 'YYYY-MM-DD') <= CURRENT_DATE + INTERVAL '1 day'
                    GROUP BY 
                        \"Serveur\" 
                    ORDER BY 
                        SUM(\"Fichier_invalide\") DESC LIMIT 6;";
        return $this->db->query($reqToServ)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getServerData() {
        $reqServer = "SELECT \"Serveur\",
                            SUM(\"Fichier_total\") AS sum_sert, 
                            SUM(\"Fichier_valide\") AS sum_serv, 
                            SUM(\"Fichier_invalide\") AS sum_serinv, 
                            SUM(\"Erreur_connexion\") AS sum_serrcon 
                        FROM 
                            public.nettoyage_serveur GROUP BY \"Serveur\";";
        return $this->db->query($reqServer)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGraphData($dateStart = null, $dateEnd = null) {
        if ($dateStart && $dateEnd) {
            $reqGrap = "SELECT *
                        FROM nettoyage_count
                        WHERE \"Date_count\" BETWEEN :datestart AND :dateend
                        ORDER BY \"Date_count\" ASC";
            
            $resGraph = $this->db->prepare($reqGrap);
            $resGraph->bindParam(':datestart', $dateStart);
            $resGraph->bindParam(':dateend', $dateEnd);
            $resGraph->execute();
        } else {
            $reqGrap = "SELECT *
                        FROM nettoyage_count
                        WHERE TO_TIMESTAMP(\"Date_count\", 'YYYY-MM-DD') >= CURRENT_DATE - INTERVAL '29 days'
                        AND TO_TIMESTAMP(\"Date_count\", 'YYYY-MM-DD') <= CURRENT_DATE + INTERVAL '1 day'
                        ORDER BY \"Date_count\" ASC";
            
            $resGraph = $this->db->query($reqGrap);
        }

        $data = [];
        while ($row = $resGraph->fetch(PDO::FETCH_ASSOC)) {
            $data[] = [
                'date' => $row['Date_count'],
                'email_valide' => (int)$row['Email_valide'],
                'email_invalide' => (int)$row['Email_invalide'],
                'erreur_connexion' => (int)$row['Erreur_connexion']
            ];
        }

        return $data;
    }
}
