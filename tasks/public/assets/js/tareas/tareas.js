$("#tareas").dataTable({
  destroy: true,
  processing: true,
  serverSide: true,
  ordering: false,
  lengthChange: false,
  pageLength: 20, // Número de filas por página
  language: {
    search: "Buscar",
  },
});
