import Router from 'vue-router'

import Ranking from './views/Ranking.vue'
import List from './views/List.vue'
import Shop from './views/Shop.vue'
import NotFound from './views/NotFound.vue'
import ShopDetail from './views/ShopDetail.vue'
import CreateUser from './views/ShopReserve.vue'
import CreateOkini from './views/ShopOkini.vue'
import ReserveDelete from './views/ReserveDelete.vue'
import OkiniDelete from './views/OkiniDelete.vue'

import ShopTonkotu from './views/ShopTonkotu.vue'
import ShopSyoyu from './views/ShopSyoyu.vue'
import ShopHomeKei from './views/ShopHomeKei.vue'
import ShopAssari from './views/ShopAssari.vue'
import ShopKotteri from './views/ShopKotteri.vue'
import ShopOrigin from './views/ShopOrigin.vue'


export default new Router({
  mode: 'history',
  routes: [
    {
      path: '*',
      component: NotFound
    },
    
    {
      path: '/user/ranking',
      name: 'ranking',
      component: Ranking
    },
    {
      path: '/user/list',
      name: 'list',
      component: List
    },
    {
      path: '/user/shops',
      name: 'shops',
      component: Shop
    },
    {
      path: '/user/shops/:id',
      name: 'shop_detail',
      component: ShopDetail
    },
    {
      path: '/user/shops/reserve/:id',
      name: 'create_user',
      component: CreateUser
    },
    {
      path: '/user/shops/okini/:id',
      name: 'create_okini',
      component: CreateOkini
    },
    {
      path: '/user/shops/delete/:id',
      name: 'reserve_delete',
      component: ReserveDelete
    },
    {
      path: '/user/shops/okini/delete/:id',
      name: 'okini_delete',
      component: OkiniDelete
    },
    //カテゴリー
    {
      path: '/user/category/tonkotu',
      name: 'tonkotu',
      component: ShopTonkotu
    },
    {
      path: '/user/category/shoyu',
      name: 'shoyu',
      component: ShopSyoyu
    },
    {
      path: '/user/category/homekei',
      name: 'homekei',
      component: ShopHomeKei
    },
    {
      path: '/user/category/assari',
      name: 'assari',
      component: ShopAssari
    },
    {
      path: '/user/category/kotteri',
      name: 'kotteri',
      component: ShopKotteri
    },
    {
      path: '/user/category/origin',
      name: 'origin',
      component: ShopOrigin
    },
  ]
});