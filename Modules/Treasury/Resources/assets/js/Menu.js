import {
    faLandmark,
    faGauge,
    faBuildingColumns,
    faMoneyCheckDollar,
    faScaleBalanced,
    faTags,
} from "@fortawesome/free-solid-svg-icons";
// menuRoute() no lanza cuando la ruta no esta en el listado de Ziggy (modulo
// deshabilitado o nombre desincronizado).
import { menuRoute } from "@/utils/menuRoute";

const menuTreasury = {
    status: false,
    text: "Tesorería",
    icom: faLandmark,
    route: "module",
    permissions: "treasury_dashboard",
    items: [
        {
            route: menuRoute("treasury_dashboard"),
            status: false,
            text: "Dashboard",
            permissions: "treasury_dashboard",
            icom: faGauge,
        },
        {
            route: menuRoute("treasury_accounts_index"),
            status: false,
            text: "Cuentas",
            permissions: "treasury_cuentas",
            icom: faBuildingColumns,
        },
        {
            route: menuRoute("treasury_transactions_index"),
            status: false,
            text: "Movimientos",
            permissions: "treasury_movimientos",
            icom: faMoneyCheckDollar,
        },
        {
            route: menuRoute("treasury_reconciliation_index"),
            status: false,
            text: "Conciliación",
            permissions: "treasury_conciliacion",
            icom: faScaleBalanced,
        },
        {
            route: menuRoute("treasury_categories_index"),
            status: false,
            text: "Categorías",
            permissions: "treasury_categorias",
            icom: faTags,
        },
    ],
};
export default menuTreasury;
