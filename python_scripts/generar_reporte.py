import mysql.connector
import pandas as pd
from datetime import datetime
import os

# Ruta de salida segura
ruta_carpeta = "C:/xampp/htdocs/tulioriera/writable/reportes/"
os.makedirs(ruta_carpeta, exist_ok=True)  # Crea la carpeta si no existe

# Conexión a la base de datos
conexion = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="tulioriera"
)

cursor = conexion.cursor(dictionary=True)

# Consultar vencimientos con datos del producto
query = """
SELECT p.codigo_riera, p.nombre, p.proveedor, p.lote, p.pasillo, v.fecha_vencimiento, v.created_at
FROM productos_deposito p
JOIN vencimientos v ON p.id = v.producto_id
WHERE p.fecha_vencimiento IS NOT NULL
ORDER BY v.fecha_vencimiento ASC
"""

cursor.execute(query)
datos = cursor.fetchall()

# Convertir resultados a DataFrame
df = pd.DataFrame(datos)

# Si hay resultados, procesamos
if not df.empty:
    hoy = datetime.today().date()
    df["dias_restantes"] = df["fecha_vencimiento"].apply(lambda f: (f - hoy).days)
    nombre_archivo = f"reporte_vencimientos_{datetime.now().strftime('%Y%m%d_%H%M%S')}.xlsx"
    ruta_salida = os.path.join(ruta_carpeta, nombre_archivo)
    df.to_excel(ruta_salida, index=False)
    print(f"Reporte generado correctamente: {ruta_salida}")
else:
    print("No hay vencimientos registrados con fecha válida.")

# Cierre de recursos
cursor.close()
conexion.close()
