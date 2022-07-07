// import './bootstrap'
const express = require("express")
const path = require('path')
const bootstrap = require('bootstrap')

const app = express();

// Bootstrap to public folder
app.use('/css', express.static(path.join(__dirname, 'node_modules/bootstrap/dist/css')))
app.use('/js', express.static(path.join(__dirname, 'node_modules/bootstrap/dist/js')))
app.use('/js', express.static(path.join(__dirname, 'node_modules/jquery/dist')))

// chartjs to public folder
app.use('/js', express.static(path.join(__dirname, 'node_modules/chartjs')))

// datatables to public folder
app.use('/js', express.static(path.join(__dirname, 'node_modules/datatables/media/js')))
app.use('/css', express.static(path.join(__dirname, 'node_modules/datatables/media/css')))
app.use('/images', express.static(path.join(__dirname, 'node_modules/datatables/media/images')))
