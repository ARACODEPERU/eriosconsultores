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
import menuHealth from 'Modules/Health/Resources/assets/js/Menu.js';
import menuRestaurant from 'Modules/Restaurant/Resources/assets/js/Menu.js';
import menuHelpdesk from 'Modules/Helpdesk/Resources/assets/js/Menu.js';
import menuDental from 'Modules/Dental/Resources/assets/js/Menu.js';
import menuBibliodata from 'Modules/Bibliodata/Resources/assets/js/Menu.js';
import menuIntegrationhub from 'Modules/Integrationhub/Resources/assets/js/Menu.js';
import menuCommercial from 'Modules/Commercial/Resources/assets/js/Menu.js';
import menuTreasury from 'Modules/Treasury/Resources/assets/js/Menu.js';
//import menuCiglesia from 'Modules/Churchcommunity/Resources/assets/js/Menu.js'
import { menuRoute } from '@/utils/menuRoute';

/**
 * Quita del menu las entradas que quedaron sin enlace.
 *
 * Ziggy lanza ("Ziggy error: route 'x' is not in the route list") cuando el
 * nombre pedido no esta en el listado que el servidor genero al renderizar la
 * pagina. Los Menu.js usan menuRoute(), que devuelve null en ese caso: un modulo
 * que no esta activo en modules_statuses.json no registra sus rutas, sus
 * entradas quedan con enlace nulo y aqui se retiran (el grupo desaparece en
 * lugar de dejar botones vacios).
 *
 * Un grupo con hijos SI se conserva aunque no tenga enlace propio: hay menus que
 * agrupan opciones con `route: null` a proposito (por ejemplo CMS > Landings o
 * Ventas > Administracion).
 */
const sanitizeItems = (items = []) =>
    items
        .map((item) => (item && item.items ? { ...item, items: sanitizeItems(item.items) } : item))
        .filter((item) => item && (!!item.route || (item.items && item.items.length > 0)));

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
    // Se listan TODOS los modulos, incluidos los que el rol actual no puede
    // abrir: el menu oculta las filas sin permiso (v-can / hasPermission), pero
    // el Modo Super Editor necesita verlas todas para poder activarlas o
    // desactivarlas por rol. Quitar un modulo de aqui lo vuelve invisible
    // tambien para el editor.
    menuConfig,
    menuSales[0],
    menuSales[1],
    menuSales[2],
    menuPurchases,
    menuOnlineshop,
    menuCMS,
    menuAcademic,
    menuRestaurant,
    menuDental,
    menuSocialevents,
    menuCRM,
    menuHealth,
    menuHelpdesk,
    // Modulos que hoy no estan activos en modules_statuses.json: sus menus usan
    // menuRoute(), asi que quedan sin enlace y sanitizeItems los retira. Al
    // activarlos, aparecen solos.
    menuBibliodata,
    menuIntegrationhub,
    menuCommercial,
    menuTreasury
]));
export default MenuData;
