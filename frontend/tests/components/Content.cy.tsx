import { Provider } from 'react-redux'
import { store }  from '../../src/store'
import Content from '../../src/components/Content'


describe('Content.cy.tsx', () => {
  it('%testName%', () => {
    cy.mount(<Provider store={store}><Content /></Provider>)
  })
})