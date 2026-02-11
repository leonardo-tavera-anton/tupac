import { Head, Link } from '@inertiajs/react';

export default function Welcome() {
  return (
    <>
      <Head title="Inicio" />

      {/* Contenedor principal */}
      <div className="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-indigo-600 to-blue-500 text-white px-6 py-12">
        <h1 className="text-5xl font-extrabold text-center mb-6">
          🚀 ¡Bienvenido a tu Panel!
        </h1>

        <p className="text-lg text-center max-w-lg mb-8">
          Esta es tu página de inicio basada en Laravel + Inertia + React + Tailwind CSS.
          Aquí puedes acceder al dashboard o iniciar sesión si aún no lo has hecho.
        </p>

        <div className="flex gap-4">
          {/* Botón para ir al Dashboard */}
          <Link
            href="/dashboard"
            className="px-6 py-3 bg-white text-indigo-700 font-semibold rounded-lg shadow-lg hover:bg-gray-100 transition"
          >
            🏠 Ir al Dashboard
          </Link>

          {/* Botón para iniciar sesión */}
          <Link
            href="/login"
            className="px-6 py-3 bg-indigo-900 text-white font-semibold rounded-lg shadow-lg hover:bg-indigo-800 transition"
          >
            🔑 Iniciar Sesión
          </Link>
        </div>

        {/* Footer */}
        <footer className="mt-10 text-sm opacity-90">
          © {new Date().getFullYear()} Municipalidad • Todos los derechos reservados
        </footer>
      </div>
    </>
  );
}
