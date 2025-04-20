
import { createApp, h } from 'vue'
import { createInertiaApp, router } from '@inertiajs/vue3'
import nProgress, { start } from 'nprogress'
import ToastPlugin from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-bootstrap.css';
createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    const page = pages[`./Pages/${name}.vue`]
    if (!page) {
      console.error(`Page [${name}] not found.`)
    }
    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
      
  },
})

router.on('start',()=>{
  nProgress.start()
})

router.on('finish',()=>{
  nProgress.done()
})