import { 
    faWheelchair, 
    faKitMedical,
    faUserDoctor,
    faTooth,
    faNotesMedical,
    faCashRegister,
    faFileMedical,
    faCalendarDays,
    faClipboardList,
    faGear
} from "@fortawesome/free-solid-svg-icons";
import menuDental from 'Modules/Dental/Resources/assets/js/Menu.js';
// menuRoute() no lanza cuando la ruta no esta en el listado de Ziggy (modulo
// deshabilitado o nombre desincronizado): la entrada queda sin enlace en lugar
// de romper la carga de todo el panel.
import { menuRoute } from "@/utils/menuRoute";

const menuHealth = {
    status:false,
    text: 'Salud',
    icom: faKitMedical,
    route: 'module',
    permissions: 'heal_dashboard',
    items: [
        {
            route: menuRoute('heal_doctors_list'),
            status: false,
            text: 'Doctores',
            icom: faUserDoctor,
            permissions: 'heal_doctores_listado',
        },
        {
            route: menuRoute('heal_patients_list'),
            status: false,
            text: 'Pacientes',
            icom: faWheelchair,
            permissions: 'heal_pacientes_listado',
        },
        {
            route: menuRoute('heal_attentions_list'),
            status: false,
            text: 'Atenciones',
            icom: faNotesMedical,
            permissions: 'heal_atenciones_listado',
        },
        {
            route: menuRoute('heal_agendas_list'),
            status: false,
            text: 'Agendas',
            icom: faCalendarDays,
            permissions: 'heal_citas_listado',
        },
        {
            route: menuRoute('heal_clinical_records_list'),
            status: false,
            text: 'Historias Clínicas',
            icom: faFileMedical,
            permissions: 'heal_pacientes_listado',
        },
        {
            route: menuRoute('heal_procedure_charges_list'),
            status: false,
            text: 'Procedimientos/cobros',
            icom: faCashRegister,
            permissions: 'heal_atenciones_listado',
        },
        menuDental,
        {
            route: menuRoute('heal_activities_list'),
            status: false,
            text: 'Registro de Actividades',
            icom: faClipboardList,
            permissions: 'heal_actividades_listado',
        },
        {
            route: menuRoute('heal_settings'),
            status: false,
            text: 'Configuración',
            icom: faGear,
            permissions: 'heal_configuracion',
        },
    ]
    
};
export default menuHealth;
