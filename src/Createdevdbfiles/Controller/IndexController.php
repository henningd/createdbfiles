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
            
            $savepath = 'module/'.$moduleName.'/src/'.$moduleName.'/Model/';
            $filename1 = $filename.'.php';
            $filename2 = $filename.'Table.php';
            
            if (!is_dir($savepath)) {
                mkdir($savepath, 0777);
            }
            
            if (!file_exists($savepath.$filename2)) {
                $txt = "<?php\n";
                $txt.= "namespace $moduleName\Model;\n";
                $txt.= "\n";
                $txt.= "use Zend\Db\TableGateway\TableGateway;";
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
                $txt.= "}";
            
                $datei = fopen($savepath.$filename2,"w+");
                fwrite($datei, $txt);
                fclose($datei);
            }
            
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
            }
        }
         
        return array();
    }
}
