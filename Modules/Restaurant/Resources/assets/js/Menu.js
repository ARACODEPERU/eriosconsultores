import {
    faBellConcierge,
    faClipboardList,
    faGauge,
    faList,
    faUtensils,
    faMoneyBillWave,
    faEllipsisVertical,
    faBoxesStacked,
    faCartShopping,
    faClipboardCheck,
} from "@fortawesome/free-solid-svg-icons";
import { menuRoute } from "@/utils/menuRoute";

const menuRestaurant = {
    status: false,
    text: "Restaurante",
    icom: faBellConcierge,
    route: 'module',
    permissions: "res_dashboard",
    items: [
        {
            route: menuRoute("res_dashboard"),
            status: false,
            text: "Panel",
            icom: faGauge,
            permissions: "res_dashboard",
            dashboard: true,
        },
        {
            route: menuRoute("res_comandas_list"),
            status: false,
            text: "Comandas",
            icom: faUtensils,
            permissions: "res_comandas",
        },
        {
            route: menuRoute("res_menu_list"),
            status: false,
            text: "Carta Del Día",
            icom: faList,
            permissions: "res_menu",
        },
        {
            route: menuRoute("res_sales_create"),
            status: false,
            text: "Vender",
            icon: faMoneyBillWave,
            permissions: "res_venta_nuevo",
        },
        {
            route: menuRoute("res_sales_list"),
            status: false,
            text: "Listado de Ventas",
            permissions: "res_venta",
            icon: faEllipsisVertical,
        },
        {
            route: menuRoute("res_sales_cuisine"),
            status: false,
            text: "Cocina",
            icom: faClipboardList,
            permissions: "res_venta",
        },
        {
            route: menuRoute("res_supplies_list"),
            status: false,
            text: "Insumos",
            icom: faBoxesStacked,
            permissions: "res_insumos",
        },
        {
            route: menuRoute("res_supplies_purchase"),
            status: false,
            text: "Registrar compra",
            icom: faCartShopping,
            permissions: "res_insumos_compra",
        },
        {
            route: menuRoute("res_supplies_shopping_list"),
            status: false,
            text: "Lista para el mercado",
            icom: faClipboardCheck,
            permissions: "res_lista_compras",
        },
    ],
};

export default menuRestaurant;
