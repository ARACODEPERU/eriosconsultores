import { faCartShopping, faHandshake } from "@fortawesome/free-solid-svg-icons";
import { menuRoute } from "@/utils/menuRoute";

const menuPurchases = {
    status: false,
    text: "Compras",
    icom: faCartShopping,
    route: 'module',
    permissions: "purc_dashboard",
    items: [
        {
            route: menuRoute("providers.index"),
            status: false,
            text: "Proveedores",
            permissions: "proveedores",
            icom: faHandshake,
        },
        {
            route: menuRoute("purc_documents_list"),
            status: false,
            text: "Documentos",
            permissions: "purc_documentos_listado",
            icom: faCartShopping,
        },
        
    ],
};
export default menuPurchases;
