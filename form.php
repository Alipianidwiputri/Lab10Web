<?php
/**
 * Nama Class: Form
 * Deskripsi: Class untuk membuat form inputan text sederhana
 **/
class Form
{
    private $fields = array();
    private $action;
    private $submit;
    private $jumField = 0;
    private $theme = 'default'; // 'default' atau 'violet'

    public function __construct($action, $submit, $theme = 'default')
    {
        $this->action = $action;
        $this->submit = $submit;
        $this->theme = $theme;
    }

    public function displayForm()
    {
        if ($this->theme === 'violet') {
            $this->displayVioletForm();
        } else {
            $this->displayDefaultForm();
        }
    }

    private function displayDefaultForm()
    {
        echo "<form action='" . $this->action . "' method='POST'>";
        echo '<table width="100%" border="0">';
        for ($j = 0; $j < count($this->fields); $j++) {
            echo "<tr><td align='right'>" . $this->fields[$j]['label'] . "</td>";
            echo "<td><input type='text' name='" . $this->fields[$j]['name'] . "'></td></tr>";
        }
        echo "<tr><td colspan='2'>";
        echo "<input type='submit' value='" . $this->submit . "'></td></tr>";
        echo "</table>";
        echo "</form>";
    }

    private function displayVioletForm()
    {
        echo "<form action='" . $this->action . "' method='POST' class='violet-form'>";
        
        for ($j = 0; $j < count($this->fields); $j++) {
            echo '<div class="violet-form-group">';
            echo '<label for="' . $this->fields[$j]['name'] . '">';
            echo '<i class="fas fa-pen"></i> ' . $this->fields[$j]['label'];
            echo '</label>';
            echo '<div class="input-wrapper">';
            echo '<i class="fas fa-edit form-icon"></i>';
            echo '<input type="text" id="' . $this->fields[$j]['name'] . '" ';
            echo 'name="' . $this->fields[$j]['name'] . '" ';
            echo 'placeholder="Masukkan ' . $this->fields[$j]['label'] . '">';
            echo '</div>';
            echo '</div>';
        }
        
        echo '<div class="violet-form-actions">';
        echo '<button type="submit" class="violet-btn violet-btn-primary">';
        echo '<i class="fas fa-paper-plane"></i> ' . $this->submit;
        echo '</button>';
        echo '</div>';
        
        echo "</form>";
        
        // Add CSS for violet form
        echo '<style>
            .violet-form {
                width: 100%;
            }
            
            .violet-form-group {
                margin-bottom: 25px;
            }
            
            .violet-form-group label {
                display: block;
                margin-bottom: 10px;
                color: #4B0082;
                font-weight: 600;
                font-size: 16px;
                display: flex;
                align-items: center;
                gap: 10px;
            }
            
            .violet-form-group label i {
                color: #8A2BE2;
                font-size: 1.2rem;
            }
            
            .violet-form-group .input-wrapper {
                position: relative;
            }
            
            .violet-form-group .form-icon {
                position: absolute;
                left: 20px;
                top: 50%;
                transform: translateY(-50%);
                color: #9370DB;
                font-size: 1.2rem;
                z-index: 1;
            }
            
            .violet-form-group input[type="text"] {
                width: 100%;
                padding: 15px 20px 15px 55px;
                border: 2px solid #9370DB;
                border-radius: 15px;
                font-size: 16px;
                transition: all 0.3s;
                background: rgba(230, 230, 250, 0.3);
                color: #333;
                box-sizing: border-box;
            }
            
            .violet-form-group input[type="text"]:focus {
                outline: none;
                border-color: #8A2BE2;
                background: white;
                box-shadow: 0 0 0 4px rgba(138, 43, 226, 0.2);
                transform: translateY(-2px);
            }
            
            .violet-form-actions {
                margin-top: 30px;
                text-align: center;
            }
            
            .violet-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 12px;
                padding: 16px 35px;
                border: none;
                border-radius: 15px;
                font-weight: 600;
                font-size: 17px;
                cursor: pointer;
                transition: all 0.3s ease;
                text-decoration: none;
            }
            
            .violet-btn-primary {
                background: linear-gradient(45deg, #8A2BE2, #9370DB);
                color: white;
                box-shadow: 0 6px 20px rgba(138, 43, 226, 0.4);
            }
            
            .violet-btn-primary:hover {
                transform: translateY(-4px);
                box-shadow: 0 10px 25px rgba(138, 43, 226, 0.6);
                background: linear-gradient(45deg, #9370DB, #8A2BE2);
            }
        </style>';
    }

    public function addField($name, $label)
    {
        $this->fields[$this->jumField]['name'] = $name;
        $this->fields[$this->jumField]['label'] = $label;
        $this->jumField++;
    }
}
?>