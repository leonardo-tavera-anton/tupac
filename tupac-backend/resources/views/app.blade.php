import { Head, Link } from '@inertiajs/react';

export default function Welcome() {
  return (
    <>
      {/* Esto pone el título en el navegador */}
      <Head title="Bienvenido" />

      {/* Contenedor central */}
      <div className="min-h-screen flex flex-col justify-center items-center bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-6">
        <h1 className="text-5xl font-bold text-center mb-6">
          🚀 Bienvenido a tu Aplicación
        </h1>

        <p className="text-lg text-center max-w-xl mb-8">
          Tu proyecto usa Laravel + Inertia + React + Tailwind con un diseño limpio y moderno.
        </p>

        <div className="flex gap-4">
          <Link
            href="/dashboard"
            className="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition"
          >
            Ir al Dashboard
          </Link>

          <Link
            href="/login"
            className="px-6 py-3 bg-gray-200 text-gray-900 font-semibold rounded-lg hover:bg-gray-300 transition"
          >
            Iniciar Sesión
          </Link>
        </div>

        <footer className="mt-12 text-sm text-gray-500 dark:text-gray-400">
          © {new Date().getFullYear()} Municipalidad - Todos los derechos reservados
        </footer>
      </div>
    </>
  );
}
