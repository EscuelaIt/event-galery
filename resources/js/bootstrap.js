import { AxiosInstanceBuilder } from '@dile/crud/lib/AxiosInstanceBuilder';

// The Axios instance setup only makes sense in the browser, not during SSR...
if (typeof window !== 'undefined') {
  new AxiosInstanceBuilder(
      {
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
        },
        baseURL: import.meta.env.VITE_API_BASE_URL,
      }
  );
}
