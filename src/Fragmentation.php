<?php namespace judison1\dbfrag;


/**
*  Fragmentation class
*
*  Use this section to define what this class is doing, the PHPDocumentator will use this
*  to automatically generate an API documentation using this information.
*
*  @author Judison Godinho
*/

use Exception;
class Fragmentation
{

    /**  @var array $fragments defines the set of fields that will be fragments on the mobile device.*/
    protected $fragments;

    /**  @var string $up_name defines the name of the suffix of the fields that will store the time of the last update in the database*/
    private $up_name;

    function __construct()
    {

        $this->fragments = array(
            'usuario' => ['nome','email','senha'],
            'tarefa'   => ['tarefa', 'observacao']
        );
        $this->up_name = "_up_at";
    }

    /**
     * fragByArray method
     *
     * This method performs a vertical fragmentation on a set of data passed in an array.
     * To fragment, this method is the time of the last update of the fields.
     *
     * @param string $timestamp It serves to decide which fields should be returned.
     * @param array $data Set of data to be fragmented.
     * @param array $tables_frag Set of tables for consultation.
     *
     * @return array
     */
    public function fragByArray(string $timestamp, array $data, array $tables_frag) : array {

        $data_frag = array('id' => $data['id'], 'updated_at' =>  $data['updated_at']);

        foreach ($tables_frag as $table){
            if(!array_key_exists($table, $this->fragments))
                throw new Exception("{$table} table does not exist.");
            foreach ($this->fragments[$table] as $frag){
                if(!array_key_exists($frag.$this->up_name, $data))
                    throw new Exception("{$frag} field does not exist");
                if($data[$frag.$this->up_name] > $timestamp){
                    $data_frag[$frag] = $data[$frag];
                }
            }
        }

        return $data_frag;
    }

    /**
     * fragByArray method
     *
     * This method performs vertical fragmentation on a set of data transmitted across multiple arrays.
     * To fragment, this method is the time of the last update of the fields.
     *
     * @param string $timestamp It serves to decide which fields should be returned.
     * @param array $data Set of data to be fragmented.
     * @param array $tables_frag Set of tables for consultation.
     *
     * @return array
     */
    public function fragByArrays(string $timestamp, array $data, array $tables_frag) : array {
        $data_frag = array();
        for ($i = 0; $i < count($data); $i++){
            $data_frag[] = $this->fragByArray($timestamp,$data[$i], $tables_frag);
        }
        return $data_frag;
    }

    /**
     * fragByArray method
     *
     * This method prepares a set of data to perform an update on the database.
     * Each updated field will record the time of the last update to serve as the basis for fragmentation.
     *
     * @param array $data Set of data to be fragmented.
     *
     * @return array
     */
    public function fragUpdate(array $data) : array {
        if (!array_key_exists('id', $data))
            throw new Exception('campo {id} não foi encontrado.');

        $now = date("Y-m-d H:i:s");
        $data_frag['id'] = $data['id'];
        foreach ($data as $key => $value){
            if ($key != 'id'){
                $data_frag[$key] = $value;
                $data_frag[$key.$this->up_name] = $now;
            }
        }
        $data_frag['updated_at'] = $now;

        return $data_frag;
    }
}