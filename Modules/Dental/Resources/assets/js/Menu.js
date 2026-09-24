import { 
    faTooth
} from "@fortawesome/free-solid-svg-icons";
import { menuRoute } from "@/utils/menuRoute";

const menuDental = { 
    route: null,
    status: false,
    text: 'Odontología',
    icom: faTooth,
    permissions: 'dental_dashboard',
    items: [
        {
            route: menuRoute('odontology_appointments_calendar'),
            status: false,
            text: 'Citas',
            permissions: 'dental_citas_listado',
        },
        {
            route: menuRoute('odontology_attention_list'),
            status: false,
            text: 'Atencion',
            permissions: 'dental_citas_listado',
        },
    ]
};
export default menuDental;
