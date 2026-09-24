import {
    faPoll,
    faGraduationCap,
    faMagnifyingGlassChart
} from "@fortawesome/free-solid-svg-icons";
import { ref, reactive } from 'vue';
import menuAcademic from 'Modules/Academic/Resources/assets/js/Menu.js';
import menuSales from 'Modules/Sales/Resources/assets/js/Menu.js';
import menuPurchases from 'Modules/Purchases/Resources/assets/js/Menu.js';
import menuConfig from 'Modules/Security/Resources/assets/js/Menu.js';
import menuCMS from 'Modules/CMS/Resources/assets/js/Menu.js';
import menuSocialevents from 'Modules/Socialevents/Resources/assets/js/Menu.js';
import menuCRM from 'Modules/CRM/Resources/assets/js/Menu.js';
import menuOnlineshop from 'Modules/Onlineshop/Resources/assets/js/Menu.js';


const MenuData = ref([
    {
        status: false,
        text: 'Dashboard',
        icom: faPoll,
        route: route("dashboard"),
        permissions: 'dashboard',
        // items:[
        //     {
        //         route: route('dashboard'),
        //         status: false,
        //         icom: faMagnifyingGlassChart,
        //         text: "General",
        //         permissions: "dashboard",
        //     },
        //     {
        //         route: route("aca_dashboard"),
        //         status: false,
        //         icom: faGraduationCap,
        //         text: "Académico",
        //         permissions: "aca_dashboard",
        //     },
        // ]
    },
    menuConfig,
    //menuPurchases,
    menuSales[0],
    menuSales[1],
    menuSales[2],
    menuOnlineshop,
    menuCMS,
    menuAcademic,
    menuSocialevents,
    menuCRM
]);
export default MenuData;
