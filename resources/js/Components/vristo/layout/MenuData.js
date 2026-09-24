import {
    faPoll,
    faGraduationCap,
    faMagnifyingGlassChart
} from "@fortawesome/free-solid-svg-icons";
import { ref, reactive } from 'vue';
import menuAcademic from 'Modules/Academic/Resources/assets/js/Menu.js';
import menuRestaurant from 'Modules/Restaurant/Resources/assets/js/Menu.js';
import menuSales from 'Modules/Sales/Resources/assets/js/Menu.js';
import menuPurchases from 'Modules/Purchases/Resources/assets/js/Menu.js';
import menuConfig from 'Modules/Security/Resources/assets/js/Menu.js';
import menuCMS from 'Modules/CMS/Resources/assets/js/Menu.js';
import menuSocialevents from 'Modules/Socialevents/Resources/assets/js/Menu.js';
import menuHelpdesk from 'Modules/Helpdesk/Resources/assets/js/Menu.js';
import menuHealth from 'Modules/Health/Resources/assets/js/Menu.js';
import menuCRM from 'Modules/CRM/Resources/assets/js/Menu.js';
import menuOnlineshop from 'Modules/Onlineshop/Resources/assets/js/Menu.js';
//import menuCiglesia from 'Modules/Churchcommunity/Resources/assets/js/Menu.js'
import menuBibliodata from 'Modules/Bibliodata/Resources/assets/js/Menu.js';
import menuIntegrationhub from 'Modules/Integrationhub/Resources/assets/js/Menu.js';
import menuCommercial from 'Modules/Commercial/Resources/assets/js/Menu.js';
import menuTreasury from 'Modules/Treasury/Resources/assets/js/Menu.js';
import { menuRoute } from '@/utils/menuRoute';

/**
 * Quita del menu las entradas cuyo enlace no existe.
 *
 * Ziggy lanza ("Ziggy error: route 'x' is not in the route list") cuando el nombre
 * pedido no esta en el listado que el servidor genero al renderizar la pagina: un
 * modulo deshabilitado no registra sus rutas y sus Menu.js quedan con enlaces
 * invalidos. Los Menu.js usan menuRoute(), que devuelve null en ese caso; aqui se
 * descartan esas entradas y los grupos que se quedan sin hijos, para que el modulo
 * desaparezca del menu en lugar de dejar enlaces vacios.
 *
 * Se aplica una sola vez, en el unico punto por el que pasan todos los
 * consumidores del menu (Sidebar-Admin, Sidebar, Header y Sidebar-Old).
 */
const sanitizeItems = (items = []) =>
    items
        .map((item) => (item && item.items ? { ...item, items: sanitizeItems(item.items) } : item))
        .filter((item) => item && item.route !== null && (!item.items || item.items.length > 0));

const MenuData = ref(sanitizeItems([
    {
        status: false,
        text: 'Dashboard',
        icom: faPoll,
        route: menuRoute("dashboard"),
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
    // menuHelpdesk,
    menuCMS,
    menuHealth,
    menuAcademic,
    menuRestaurant,
    menuSocialevents,
    menuCRM,
    // menuCiglesia,
    menuBibliodata,
    menuIntegrationhub,
    menuCommercial,
    menuTreasury
]));
export default MenuData;
