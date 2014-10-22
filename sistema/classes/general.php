<?php
/**
 *     Class for General purpose methods
**/

class Gen 
{
    // Properties

    // Methods
    public function __construct() {
    }

    public function nameField($field, $siteSettings) {       // Use the alternate name across site
        switch ($field) {
            case 'customField' :
            $name = $siteSettings->customField1;
            break;
            case 'customField2':
            $name = $siteSettings->customField2;
            break;
            case 'customField3':
            $name = $siteSettings->customField3;
            break;
         case 'customField4':
            $name = $siteSettings->customField4;
            break;
         case 'customField5':
            $name = $siteSettings->customField5;
            break;
         case 'customField6':
            $name = $siteSettings->customField6;
            break;
         case 'customField7':
            $name = $siteSettings->customField7;
            break;
         case 'customField8':
            $name = $siteSettings->customField8;
            break;
         case 'customField9':
            $name = $siteSettings->customField9;
            break;
         case 'customField10':
            $name = $siteSettings->customField10;
            break;
        
        
        //+10 campos extra 
        
            case 'customField11' :
            $name = $siteSettings->customField11;
            break;
            case 'customField12':
            $name = $siteSettings->customField12;
            break;
            case 'customField13':
            $name = $siteSettings->customField13;
            break;
         case 'customField14':
            $name = $siteSettings->customField14;
            break;
         case 'customField15':
            $name = $siteSettings->customField15;
            break;
         case 'customField16':
            $name = $siteSettings->customField16;
            break;
         case 'customField17':
            $name = $siteSettings->customField17;
            break;
         case 'customField18':
            $name = $siteSettings->customField18;
            break;
         case 'customField19':
            $name = $siteSettings->customField19;
            break;
         case 'customField20':
            $name = $siteSettings->customField20;
            break;
        
         //+10 campos extra 
        
            case 'customField21' :
            $name = $siteSettings->customField21;
            break;
            case 'customField22':
            $name = $siteSettings->customField22;
            break;
            case 'customField23':
            $name = $siteSettings->customField23;
            break;
         case 'customField24':
            $name = $siteSettings->customField24;
            break;
         case 'customField25':
            $name = $siteSettings->customField25;
            break;
         case 'customField26':
            $name = $siteSettings->customField26;
            break;
         case 'customField27':
            $name = $siteSettings->customField27;
            break;
         case 'customField28':
            $name = $siteSettings->customField28;
            break;
         case 'customField29':
            $name = $siteSettings->customField29;
            break;
         case 'customField30':
            $name = $siteSettings->customField30;
            break;
        
            case 'Address':
            $name = $siteSettings->Address;
            break;
            case 'City':
            $name = $siteSettings->City;
            break;
            case 'State':
            $name = $siteSettings->State;
            break;
            case 'Country':
            $name = $siteSettings->Country;
            break;
            case 'Zip':
            $name = $siteSettings->Zip;
            break;
            case 'Phone':
            $name = $siteSettings->Phone;
            break;
            case 'secondaryPhone':
            $name = $siteSettings->secondaryPhone;
            break;
            case 'Fax':
            $name = $siteSettings->Fax;
            break;
        case 'operadora':
            $name = $siteSettings->operadora;
            break;
        //incluir todos os campos da tb leads 
        
        /*
                incluir bloco abaixo para cada campo extra 
                        case 'idd':
                          $name = $siteSettings->idd;
                          break;


        */
        
        case 'referencia':
            $name = $siteSettings->Fax;
            break;
        case 'id':
            $name = $siteSettings->idd;
            break;
        case 'Fax':
            $name = $siteSettings->Fax;
            break;
        case 'Fax':
            $name = $siteSettings->Fax;
            break;
        case 'Fax':
            $name = $siteSettings->Fax;
            break;
            case 'assignedTo':
            $name = 'Owner';
            break;
            default:
            $name = $field;
        }
        return $name;
    }
}
