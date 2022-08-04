import "./bootstrap";
import "../sass/app.scss";

import * as bootstrap from "bootstrap";

import jQuery from "jquery";
window.$ = jQuery;

import DataTable from "datatables.net-bs5";
DataTable(window, window.$);
