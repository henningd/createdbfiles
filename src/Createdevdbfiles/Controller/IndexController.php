<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Createdevdbfiles for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Createdevdbfiles\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        if($this->getRequest()->isPost()) {
            $moduleName = (string) $this->getRequest()->getPost('modulname');
            $table = (string) $this->getRequest()->getPost('tablename');
            $filename = (string) $this->getRequest()->getPost('filename');
            
            $savepath1 = 'module/'.$moduleName;
            $savepath2 = 'module/'.$moduleName.'/src';
            $savepath3 = 'module/'.$moduleName.'/src/'.$moduleName;
            $savepath4 = 'module/'.$moduleName.'/src/'.$moduleName.'/Model';
            $savepath5 = 'module/'.$moduleName.'/src/'.$moduleName.'/Controller';    
            
            $savepath = 'module/'.$moduleName.'/src/'.$moduleName.'/Model/';
            $filenameLower = strtolower($filename);
            $filename1 = $filename.'.php';
            $filename2 = $filename.'Table.php';
            $filename3 = $filename.'Controller.php';
            
            if (!is_dir($savepath1)) {
                mkdir($savepath1, 0777);
            }
            if (!is_dir($savepath2)) {
                mkdir($savepath2, 0777);
            }
            if (!is_dir($savepath3)) {
                mkdir($savepath3, 0777);
            }
            if (!is_dir($savepath4)) {
                mkdir($savepath4, 0777);
            }
            
            if (!is_dir($savepath)) {
                mkdir($savepath, 0777);
            }


            // [Dateiname]Table.php
            if (!file_exists($savepath.$filename2)) {
                $txt = "<?php\n";
                $txt.= "namespace $moduleName\Model;\n";
                $txt.= "\n";
                $txt.= "use Zend\Db\ResultSet\ResultSet;";
                $txt.= "\n";
                $txt.= "use Zend\Db\TableGateway\TableGateway;";
                $txt.= "\n";
                $txt.= "use Zend\Db\Sql\Select;";
                $txt.= "\n";
                $txt.= "use Zend\Paginator\Adapter\DbSelect;";
                $txt.= "\n";
                $txt.= "use Zend\Paginator\Paginator;";
                $txt.= "\n";
                $txt.= "\n";
                $txt.= "class $filename";
                $txt.= "Table\n";
                $txt.= "{\n";
                $txt.= '    protected $tableGateway;';
                $txt.= "\n";
                $txt.= "\n";
                $txt.= '    public function __construct(TableGateway $tableGateway)';
                $txt.= "\n";
                $txt.= "    {";
                $txt.= "\n";
                $txt.= '        $this->tableGateway = $tableGateway;';
                $txt.= "\n";
                $txt.= "    }";
                
                $txt.= "\n";
                $txt.= "\n";
                $txt.= '    public function fetchAll($paginated=false)';
                $txt.= "\n";
                $txt.= "    {";
                $txt.= "\n";
                $txt.= '        if ($paginated) {';
                $txt.= "\n";
                $txt.= '            $select = new Select(';
                $txt.= "'";
                $txt.= $table;
                $txt.= "');";
                $txt.= "\n";
                $txt.= '            $resultSetPrototype = new ResultSet();';
                $txt.= "\n";
                $txt.= '            $resultSetPrototype';
                $txt.= "->setArrayObjectPrototype(new $filename());";
                $txt.= "\n";
                $txt.= '            $paginatorAdapter';
                $txt.= " = new DbSelect(";
                $txt.= "\n";
                $txt.= '                $select,';
                $txt.= "\n";
                $txt.= '                $this->tableGateway->getAdapter(),';
                $txt.= "\n";
                $txt.= '                $resultSetPrototype';
                $txt.= "\n";
                $txt.= "            );";
                $txt.= "\n";
                $txt.= '            $paginator = new Paginator($paginatorAdapter);';
                $txt.= "\n";
                $txt.= '            return $paginator;';
                $txt.= "\n";
                $txt.= '        }';
                $txt.= "\n";
                $txt.= "\n";
                $txt.= '        $resultSet = $this->tableGateway->select();';
                $txt.= "\n";
                $txt.= '        return $resultSet;';
                $txt.= "\n";
                $txt.= "    }";
                $txt.= "\n";
                
                $txt.= "\n";
                $txt.= "\n";
                $txt.= '    public function get($id=0)';
                $txt.= "\n";
                $txt.= "    {";
                $txt.= "\n";
                $txt.= '        $id = (int) $id;';
                $txt.= "\n";
                $txt.= "\n";
                $txt.= '        $select = $this->tableGateway->getSql()->select();';
                $txt.= "\n";
                $txt.= '        $select->where(array(';
                $txt.= "\n";
                $txt.= '            "id = ';
                $txt.= "'";
                $txt.= '$id';
                $txt.= "'";
                $txt.= '",';
                $txt.= "\n";
                $txt.= "        ));";
                $txt.= "\n";
                $txt.= "\n";
                $txt.= '        $row = $this->tableGateway->selectWith($select);';
                $txt.= "\n";
                $txt.= '        return $row;';
                $txt.= "\n";
                $txt.= "\n";
                $txt.= "    }";
                $txt.= "\n";
                $txt.= "\n";
                
                $txt.= "    public function get$filename";
                $txt.= '($idPage=0)';
                $txt.= "\n";
                $txt.= "    {";
                $txt.= "\n";
                $txt.= '        $select = $this->tableGateway->getSql()->select();';
                $txt.= "\n";
                $txt.= "\n";
                $txt.= '        $select->where(array(';
                $txt.= "\n";
                $txt.= '            "page = $idPage"';
                $txt.= "\n";
                $txt.= '        ));';
                $txt.= "\n";
                $txt.= "\n";
                $txt.= '        $select';
                $txt.= "->order('id ASC');";
                $txt.= "\n";
                $txt.= "\n";
                $txt.= '        $row = $this->tableGateway->selectWith($select);';
                $txt.= "\n";
                $txt.= '        return $row;';
                $txt.= "\n";
                $txt.= "\n";
                $txt.= "    }";
                $txt.= "\n";
                $txt.= "\n";
                
                $txt.= '    public function save(';
                $txt.= "$filename ";
                $txt.= '$';
                $txt.= strtolower($filename);
                $txt.= ')';
                $txt.= "\n";
                $txt.= "    {";
                $txt.= "\n";
                $txt.= '        $data = array(';
                $txt.= "\n";
                
                $db = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
                $sql = "SELECT * FROM $table LIMIT 1";
                $statement = $db->query($sql);
                $res =  $statement->execute();
                
                if($res instanceof ResultInterface && $res->isQueryResult()){
                    $resultSet = new ResultSet;
                    $resultSet->initialize($res);
                
                    foreach($resultSet as $row => $value){
                        foreach($value as $key => $valueData){
                            $txt.= "            '".$key."' => ";
                            $txt.= '$';
                            $txt.= strtolower($filename);
                            $txt.= "->";
                            $txt.= $key;
                            $txt.= ",\n";
                        }
                    }
                }
                
                $txt.= '        );';
                $txt.= "\n";
                $txt.= "\n";
                $txt.= '        $id = (int)$';
                $txt.= strtolower($filename);
                $txt.= '->id;';
                $txt.= "\n";
                $txt.= '        if ($id == 0) {';
                $txt.= "\n";
                $txt.= '            $this->tableGateway->insert($data);';
                $txt.= "\n";
                $txt.= '            $dbAdapter = $this->tableGateway->adapter;';
                $txt.= "\n";
                $txt.= '            $lastId = $dbAdapter->getDriver()->getConnection()->getLastGeneratedValue();';
                $txt.= "\n\n";
                $txt.= '            return $lastId;';
                $txt.= "\n";
                $txt.= '        } else {';
                $txt.= "\n";
                $txt.= '            if ($this->get($id)) {';
                $txt.= "\n";
                $txt.= '                $this->tableGateway->update($data, array(';
                $txt.= "'id' => ";
                $txt.= '$id));';
                $txt.= "\n";
                $txt.= '            } else {';
                $txt.= "\n";
                $txt.= "                throw new \Exception('Form id does not exist');";
                $txt.= "\n";
                $txt.= '            }';
                $txt.= "\n";
                $txt.= '        }';
                $txt.= "\n";
                $txt.= "    }";
                $txt.= "\n";
                $txt.= "\n";
                
                $txt.= "    public function delete";
                $txt.= '($id=0)';
                $txt.= "\n";
                $txt.= "    {";
                $txt.= "\n";
                $txt.= '        $this->tableGateway->delete(array(';
                $txt.= "'id' => ";
                $txt.= '$id));';
                $txt.= "\n";
                $txt.= "    }";
                $txt.= "\n";
                $txt.= "\n";
                
                $txt.= "}";
            
                $datei = fopen($savepath.$filename2,"w+");
                fwrite($datei, $txt);
                fclose($datei);
                chmod($savepath.$filename2, 0755);
            }


            // [Dateiname].php
            $txt = "";
            if (!file_exists($savepath.$filename1)) {
                $txt = "<?php\n";
                $txt.= "namespace $moduleName\Model;\n";
                $txt.= "\n";
                $txt.= "use Zend\InputFilter\Factory as InputFactory;\n";
                $txt.= "use Zend\InputFilter\InputFilter;\n";
                $txt.= "use Zend\InputFilter\InputFilterAwareInterface;\n";
                $txt.= "use Zend\InputFilter\InputFilterInterface;\n";
                $txt.= "\n";
                $txt.= "class $filename implements InputFilterAwareInterface\n";
                $txt.= "{\n";
            
                $db = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
                $sql = "SELECT * FROM $table LIMIT 1";
                $statement = $db->query($sql);
                $res =  $statement->execute();
            
                if($res instanceof ResultInterface && $res->isQueryResult()){
                    $resultSet = new ResultSet;
                    $resultSet->initialize($res);
            
                    foreach($resultSet as $row => $value){
                        foreach($value as $key => $valueData){
                            $txt.= "    public $".$key.";\n";
                        }
                    }
                }
            
                $txt.= "\n";
                $txt.= '    protected $inputFilter;';
                $txt.= "\n";
                $txt.= "\n";
                $txt.= '    public function exchangeArray($data)';
                $txt.= "\n";
                $txt.= "    {\n";
            
                $db = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
                $sql = "SELECT * FROM $table LIMIT 1";
                $statement = $db->query($sql);
                $res =  $statement->execute();
            
                if($res instanceof ResultInterface && $res->isQueryResult()){
                    $resultSet = new ResultSet;
                    $resultSet->initialize($res);
            
                    foreach($resultSet as $row => $value){
                        foreach($value as $key => $valueData){
                            $txt.= '        $this->';
                            $txt.= $key;
                            $txt.= ' = (isset($data[';
                            $txt.= "'";
                            $txt.= $key;
                            $txt.= "'";
                            $txt.= "])) ? ";
                            $txt.= '$data';
                            $txt.= "['";
                            $txt.= $key;
                            $txt.= "'] : null;\n";
                        }
                    }
                }
            
                $txt.= "\n";
                $txt.= "    }\n";
            
                $txt.= "\n";
                $txt.= '    public function getArrayCopy()';
                $txt.= "\n";
                $txt.= "    {";
                $txt.= "\n";
                $txt.= '        return get_object_vars($this);';
                $txt.= "\n";
                $txt.= "    }";
                $txt.= "\n";
                $txt.= "\n";
            
                $txt.= '    public function setInputFilter(InputFilterInterface $inputFilter)';
                $txt.= "\n";
                $txt.= "    {";
                $txt.= "\n";
                $txt.= '        throw new \Exception("Not used");';
                $txt.= "\n";
                $txt.= "    }";
                $txt.= "\n";
                $txt.= "\n";
            
                $txt.= '    public function getInputFilter()';
                $txt.= "\n";
                $txt.= "    {";
                $txt.= "\n";
                $txt.= '        if (!$this->inputFilter) {';
                $txt.= "\n";
                $txt.= '            $inputFilter = new InputFilter();';
                $txt.= "\n";
                $txt.= '            $factory     = new InputFactory();';
                $txt.= "\n";
                $txt.= "\n";
                $txt.= '            $inputFilter->add($factory->createInput(array(';
                $txt.= "\n";
                $txt.= "                'name'     => 'id',";
                $txt.= "\n";
                $txt.= "                'required' => true,";
                $txt.= "\n";
                $txt.= "                'filters'  => array(";
                $txt.= "\n";
                $txt.= "                    array('name' => 'Int'),";
                $txt.= "\n";
                $txt.= "                ),";
                $txt.= "\n";
                $txt.= "            )));";
                $txt.= "\n";
                $txt.= '            $this->inputFilter = $inputFilter;';
                $txt.= "\n";
                $txt.= "        }";
                $txt.= "\n";
                $txt.= "\n";
                $txt.= '        return $this->inputFilter;';
                $txt.= "\n";
                $txt.= "    }";
                $txt.= "\n";
                $txt.= "}";
            
                $datei = fopen($savepath.$filename1,"w+");
                fwrite($datei, $txt);
                fclose($datei);
                chmod($savepath.$filename1, 0755);
            }


            // Controller anlegen
            $txt = "<?php\n";
            $txt.= "/*";
            $txt.= "\n";
            $txt.= "* Für Application Module.php\n";
            $txt.= "*/";
            $txt.= "\n\n";
            $txt.= "// In Kopf kopieren\n";
            $txt.= 'use '.$moduleName.'\Model\\'.$filename.';';
            $txt.= "\n";
            $txt.= 'use '.$moduleName.'\Model\\'.$filename.'Table;';
            $txt.= "\n\n";
            $txt.= "// In public function getServiceConfig 'factories' kopieren\n";
            $txt.= '\'\\'.$moduleName.'\Model\\'.$filename.'Table\' =>  function($sm) {';
            $txt.= "\n";
            $txt.= '    $tableGateway = $sm->get(\'\\'.$filename.'TableGateway\');';
            $txt.= "\n";
            $txt.= '    $table = new \\'.$filename.'Table($tableGateway);';
            $txt.= "\n";
            $txt.= '    return $table;';
            $txt.= "\n";
            $txt.= '},';
            $txt.= "\n";
            $txt.= '\'\\'.$filename.'TableGateway\' => function ($sm) {';
            $txt.= "\n";
            $txt.= '    $dbAdapter = $sm->get(\'Zend\Db\Adapter\Adapter\');';
            $txt.= "\n";
            $txt.= '    $resultSetPrototype = new ResultSet();';
            $txt.= "\n";
            $txt.= '    $resultSetPrototype->setArrayObjectPrototype(new \\'.$filename.'());';
            $txt.= "\n";
            $txt.= '},';
            $txt.= "\n\n\n";

            $txt.= "/*";
            $txt.= "\n";
            $txt.= "* Für Controller, der Daten aus der Tabelle benötigt\n";
            $txt.= "*/";
            $txt.= "\n\n";
            $txt.= "// In Kopf kopieren\n";
            $txt.= 'use '.$moduleName.'\Model\\'.$filename.';';
            $txt.= "\n\n";
            $txt.= "// In Class kopieren\n";
            $txt.= 'protected $'.$filenameLower.'eTable;';
            $txt.= "\n\n";
            $txt.= "// In Fuss kopieren\n";
            $txt.= "public function ".$filenameLower."Table()";
            $txt.= "\n";
            $txt.= "{";
            $txt.= "\n";
            $txt.= '    if (!$this->'.$filenameLower.'Table) {';
            $txt.= "\n";
            $txt.= '        $sm = $this->getServiceLocator();';
            $txt.= "\n";
            $txt.= '        $this->'.$filenameLower.'Table = $sm->get(\''.$moduleName.'\Model\\'.$filename.'Table\');';
            $txt.= "\n";
            $txt.= "    }";
            $txt.= "\n";
            $txt.= '    return $this->'.$filenameLower.'Table;';
            $txt.= "\n";
            $txt.= "}";
            $txt.= "\n";
            $txt.= "\n";
            $txt.= "// Wenn Formular gesendet wurde\n";
            $txt.= 'if($this->getRequest()->isPost()) {';
            $txt.= "\n";
            $txt.= '    $formDatas = $this->getRequest()->getPost();';
            $txt.= "\n\n";
            $txt.= '    if (isset($formDatas[\'active\'])) {';
            $txt.= "\n";
            $txt.= '        $active = 1;';
            $txt.= "\n";
            $txt.= '    } else {';
            $txt.= "\n";
            $txt.= '        $active = 0;';
            $txt.= "\n";
            $txt.= '    }';
            $txt.= "\n\n";
            $txt.= '    $date = new DateTime();';
            $txt.= "\n";
            $txt.= '    $todayDE = $date->format(\'d.m.Y\');';
            $txt.= "\n";
            $txt.= '    $todayDB = $date->format(\'Y-m-d\');';
            $txt.= "\n";
            $txt.= '    $todayDBLong = $date->format(\'Y-m-d H:i\');';
            $txt.= "\n\n";
            $txt.= '    if (isset($_ENV[\'REMOTE_ADDR\'])) {';
            $txt.= "\n";
            $txt.= '        $ip = $_ENV[\'REMOTE_ADDR\'];';
            $txt.= "\n";
            $txt.= '    } elseif (isset($_SERVER[\'REMOTE_ADDR\'])) {';
            $txt.= "\n";
            $txt.= '        $ip = $_SERVER[\'REMOTE_ADDR\'];';
            $txt.= "\n";
            $txt.= '    } else {';
            $txt.= "\n";
            $txt.= '        $ip = \'127.0.0.1\';';
            $txt.= "\n";
            $txt.= '    }';
            $txt.= "\n\n";
            $txt.= '    $'.$filenameLower.'Data = array(';
            $txt.= "\n";

            $db = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
            $sql = "SELECT * FROM $table LIMIT 1";
            $statement = $db->query($sql);
            $res =  $statement->execute();

            if($res instanceof ResultInterface && $res->isQueryResult()){
                $resultSet = new ResultSet;
                $resultSet->initialize($res);

                foreach($resultSet as $row => $value){
                    foreach($value as $key => $valueData){
                        $txt.= "        '".$key."' => ";
                        $txt.= '$formDatas[\'';
                        $txt.= strtolower($key);
                        $txt.= '\']';
                        $txt.= ",\n";
                    }
                }
            }

            $txt.= '    );';
            $txt.= "\n\n";
            $txt.= '    $'.$filenameLower.' = new '.$filename.'();';
            $txt.= "\n";
            $txt.= '    $'.$filenameLower.'->exchangeArray($'.$filenameLower.'Data);';
            $txt.= "\n";
            $txt.= '    $this->'.$filenameLower.'Table()->save($'.$filenameLower.');';
            $txt.= "\n";
            $txt.= '}';
            $txt.= '';
            $txt.= "\n";


            $datei = fopen($savepath5.$filename3,"w+");
            fwrite($datei, $txt);
            fclose($datei);
            chmod($savepath5.$filename3, 0755);

        }
         
        return array();
    }
}
