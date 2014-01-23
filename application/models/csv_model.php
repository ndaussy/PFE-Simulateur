<?php
//Not Implemented
class Csv_model extends CI_Model {
     
   public function save_csv($file_name,$name_simulation)
	{

        // for set memory limit & execution time
       ini_set('memory_limit', '512M');
       ini_set('max_execution_time', '180');

       $etat_simu=true;

        try
        {
            if (($handle = fopen($file_name, "r")) !== FALSE) {
                # Set the parent multidimensional array key to 0.

                $line=0;
                $arrayfinal=array();
                $arraywithname=array();

                while (($data = fgetcsv($handle, 0, ";")) !== FALSE)
                {

                    if($line==0)//creation de la premiere ligne & du tableau
                    {
                        foreach ($data as $key => $value)
                        {

                            $arraywithname[$value]=0;
                            //echo "Clé : $key; Valeur : $value<br />\n";
                        }

                        $line++;
                    }
                    else
                    {
                        $cpt=0;
                        foreach ($arraywithname as $key => $value)//cipue des donnée
                        {
                            $arraywithname[$key]=$data[$cpt];
                            $cpt++;
                        }

                        $arrayforinsertion=$arraywithname;

                        $date="";
                        $cpt=0;
                        //creation du format "Date"
                        /*foreach($arraywithname as $key => $value)
                        {
                            if($cpt<6)
                            {
                                $date=$date.$arrayforinsertion[$key]." ";

                                unset($arrayforinsertion[$key]);

                                $cpt++;
                            }
                            else
                            {
                                break;
                            }

                        }
                        */
                        //Annee	Mois	Jour	Heure	Minute	Seconde
                        $date=date_create($arrayforinsertion['Annee']."-".$arrayforinsertion['Mois']."-".$arrayforinsertion['Jour']." ".$arrayforinsertion['Heure'].":".$arrayforinsertion['Minute'].":".$arrayforinsertion['Seconde']);

                        unset($arrayforinsertion['Annee']);
                        unset($arrayforinsertion['Mois']);
                        unset($arrayforinsertion['Jour']);
                        unset($arrayforinsertion['Heure']);
                        unset($arrayforinsertion['Minute']);
                        unset($arrayforinsertion['Seconde']);

                        $arrayforinsertion["Date"] = $date->format('Y-m-d H:i:s');

                        $arrayforinsertion["name_simulation"]=$name_simulation;

                        //on blinde pour voir si il existe déjà une insertion

                        if($this->is_in_csv_table($arrayforinsertion)==false)
                        {
                            $this->insert_data_csv($arrayforinsertion);

                        }

                    }

                    //on blinde pour voir si il existe déjà une insertion
                   /* if($this->select_data_all($arrayforinsertion))
                    {
                        //derniere etapes insertion dans la bdd
                        $this->insert_data_csv($arrayfinal);
                    }
                    */
                }
                # Close the File.
                fclose($handle);

            }




        }
        catch ( Exception $e )
        {
        echo 'Caught exception: ', $e->getMessage (), "\n";
        $etat_simu= false;
        }

        if($etat_simu)
        {
            unlink($file_name);

        }

        return $etat_simu;




    }

    public function is_in_csv_table($data)
    {
        try
        {


            $q=$this->db->query(" SELECT * FROM (`csv`) WHERE `Scumul` = ".$data['Scumul']."
                                AND `name_simulation` = \"".$data['name_simulation']."\" ;");



           if($q->num_rows()!=0)
           {

               return true;

           }
           else
           {
               return false;
           }

           /*AND`Actual Engine - Percent Torque` = ".$data['Actual Engine - Percent Torque']."
        AND `Engine Speed` = ".$data['Engine Speed']."
        AND `Parking Brake Switch` = ".$data['Parking Brake Switch']."
        AND `Wheel-Based vehicule Speed` = ".$data['Wheel-Based vehicule Speed']."
        AND `Brake Switch` = ".$data['Brake Switch']."
        AND `Accelerator pedal position 1` = ".$data['Accelerator pedal position 1']."
        AND `Transmission Selected gear` = ".$data['Transmission Selected gear']."
        AND `Transmission Current Gear`= ".$data['Transmission Current Gear']."
        AND `Engine Coolant Temperature` = ".$data['Engine Coolant Temperature']."
        AND `Engine Fuel Temperature` = ".$data['Engine Fuel Temperature']."
        AND `Seconds` = ".$data['Seconds']."
        AND `Minutes` = ".$data['Minutes']."
        AND `Hours` = ".$data['Hours']."
        AND `Month` = ".$data['Month']."
        AND `Day` = ".$data['Day']."
        AND `Year` = ".$data['Year']."
        AND `Local minute offset` = ".$data['Local minute offset']."
        AND `Local hour offset` = ".$data['Local hour offset']."
        AND `High Resolution Total Vehicle Distance` = ".$data['High Resolution Total Vehicle Distance']."
        AND `Total Vehicle distance` = ".$data['Total Vehicle distance']."
        AND `Position of doors` = ".$data['Position of doors']."
        AND `Engine fuel rate` = ".$data['Engine fuel rate']."
        AND `Engine Instantaneous fuel economy` = ".$data['Engine Instantaneous fuel economy']."
        AND `Fuel Level` = ".$data['Fuel Level']."
        AND `Engine Total Fuel Used` = ".$data['Engine Total Fuel Used']."
        AND `Compass Bearing` = ".$data['Compass Bearing']."
        AND `Navigation-Based Vehicule Speed` = ".$data['Navigation-Based Vehicule Speed']."
        AND `Altitude` = ".$data['Altitude']."
        AND `Latitude` = ".$data['Latitude']."
        AND `Longitude` = ".$data['Longitude']."
        AND `Date` = \"".$data['Date']."\"
           */

        }catch (Exception $ex)
        {
            echo $ex->getMessage();
            return false;
        }
    }

    public function insert_data_csv($data)
    {
        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', '2780');

        try
        {

            //return $this->db->insert('csv',$data);

            $q="INSERT INTO csv (";

            $cpt=count($data);
            $cpt_2=0;

            foreach($data as $key => $value)
            {
                $cpt_2++;
                if($cpt_2!=$cpt)
                {
                    $q = $q."`".$key."`, ";
                }
                else
                {
                    $q = $q."`".$key."` ) Values (";
                }

            }
            $cpt_2=0;
            foreach($data as $key => $value)
            {
                $cpt_2++;
                if($cpt_2!=$cpt)
                {
                    $q = $q."\"".$value."\", ";
                }
                else
                {
                    $q = $q."\"".$value."\" )";
                }

            }

            $q=$this->db->query($q);


        }Catch(Exception $sql)
        {
            echo $sql->getMessage();
        }
    }

    public function delete_data_csv($Array_name_simulation)
    {
        try
        {
            if($this->is_in_csv($Array_name_simulation))
            {
            $this->db->delete('csv', $Array_name_simulation);
            return true;
            }
            else
            {
            return false;
            }
        }Catch(SQLiteException $sql)
        {
            echo $sql;
        }
    }

    public function is_in_csv($arraySimulationName)
    {
        $q=$this->db->get_where('csv',$arraySimulationName);

        if($q->num_rows()!=0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }


   public function returnInformation($arrayInfo)
   {
       $q=$this->db->get('csv',$arrayInfo);

       if($q->num_rows()==1)
       {
          return $array_sql=$q->result_array();

          /* for($nb_line=0;$nb_line<count($array_sql);$nb_line++)
           {
               $frame = str_split ($array_sql[$nb_line]['frame'], 2);

               $array_sql[$nb_line]['frame']=$frame[0]." ".$frame[1]." ".$frame[2]." ".$frame[3]." ".$frame[4]." ".$frame[5]." ".$frame[6]." ".$frame[7];
           }
            */

       }
       else
       {
           $array_sql=array('0'=>array('time'=>0,'id'=>0,'frame'=>0));
       }

       return $array_sql;
   }

    public function select_data_csv_by_time($arraysimu)
    {

        $q=$this->db->get_where('csv',$arraysimu);

        return $q->result_array();
    }
	
}
?>